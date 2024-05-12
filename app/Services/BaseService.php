<?php

namespace App\Services;

use App\Http\Requests\ImageStoreRequest;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class BaseService
 */
abstract class BaseService implements ServiceInterface
{
    protected BaseRepository $repository;

    /**
     * @param $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): array
    {
        $validator = Validator::make($request->all(), $this->getStoreFormRequest()->rules());

        if ($validator->fails()) {
            return [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Register not created.',
                'errors' => $validator->errors(),
            ];
        }

        return [
            'status' => Response::HTTP_CREATED,
            'message' => 'Created successfully',
            'data' => $this->repository->store($request->all()),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function storeImage(Request $request, $id): array
    {
        $validator = Validator::make($request->all(), (new ImageStoreRequest())->rules());

        if ($validator->fails()) {
            return [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Register not created.',
                'errors' => $validator->errors(),
            ];
        }

        $fileName = $this->setFileName($request);

        if ($oldFile = $this->repository->hasImage($this->repository->getModel()->findOrFail($id))) {
            try {
                unlink(storage_path('app/'.$oldFile));
            } catch (Throwable) {
                //
            }
        }

        $path = $request->file('photo')->storeAs('public/images', $fileName);

        $data = [
            'photo' => $path,
        ];

        return [
            'status' => Response::HTTP_CREATED,
            'message' => 'Image uploaded successfully',
            'data' => $this->repository->storeImage($data, $this->repository->getModel()->findOrFail($id)),
        ];
    }

    /**
     * @param $id
     * @return array|BinaryFileResponse
     */
    public function getImage($id): array|BinaryFileResponse
    {
        try {
            $model = $this->repository->getModel()->findOrFail($id);
        } catch (Throwable $e) {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Register not found.',
            ];
        }

        $path = $this->repository->hasImage($model);

        if ($path) {
            return response()->file(storage_path('app/'.$path));
        }

        return [
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Image not found',
        ];
    }

    /**
     * @param $request
     * @return string
     */
    protected function setFileName($request): string
    {
        $timestamp = preg_replace('/[^0-9]/', '', now());

        return $timestamp.'-'.$request->file('photo')->getClientOriginalName();
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): array

    {
        $validator = Validator::make($request->all(), $this->getUpdateFormRequest()->rules($id));

        try {
            $model = $this->repository->getModel()->findOrFail($id);
        } catch (Throwable $e) {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Register not found.',
            ];
        }

        if ($validator->fails()) {
            return [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Register not updated.',
                'errors' => $validator->errors(),
            ];
        }

        return [
            'status' => Response::HTTP_OK,
            'message' => 'Updated successfully',
            'data' => $this->repository->update($request->all(), $model),
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    public function destroy(int $id): array
    {
        try {
            $model = $this->repository->getModel()->findOrFail($id);
        } catch (Throwable $e) {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Register not found.',
            ];
        }

        $this->repository->destroy($model);

        return [
            'status' => Response::HTTP_OK,
            'message' => 'Deleted successfully',
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    public function restore(int $id): array
    {
        try {
            $model = $this->repository->getModel()->withTrashed()->findOrFail($id);
        } catch (Throwable $e) {
            return [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Register not found.',
            ];
        }

        $this->repository->restore($model);

        return [
            'status' => Response::HTTP_OK,
            'message' => 'Restored successfully',
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function search(Request $request): array
    {
        $limit = $request->query('limit', 15);
        $limit = $limit > 50 ? 50 : $limit;
        $search = $request->query('search', []);
        $filter = $request->query('filter', []);
        $with = $request->query('with', []);
        $status = $request->query('status', 'active');

        $data = $this->repository->getModel();

        if ($status === 'deleted') {
            $data = $data->onlyTrashed();
        }

        if ($status === 'all') {
            $data = $data->withTrashed();
        }

        if (count($search) > 0) {
            foreach ($search as $key => $value) {
                $data = $data->whereRaw('unaccent(CAST('.$key." AS TEXT)) ilike unaccent('%".$value."%')");
            }
        }

        if (count($filter) > 0) {
            foreach ($filter as $key => $value) {
                $data = $data->where($key, $value);
            }
        }

        if (count($with) > 0) {
            foreach ($with as $relation => $columns) {
                $data = $data->with($relation.':'.$columns);
            }
        }

        $data = $this->repository->search($data, $limit);

        $this->setDataAdditionalManipulation($data);

        if ($data->count() === 0) {
            return [
                'status' => Response::HTTP_OK,
                'message' => 'Data not found, review the request parameters.',
                'data' => $data,
            ];
        }

        return [
            'status' => Response::HTTP_OK,
            'message' => 'Data found successfully',
            'data' => $data,
        ];
    }

    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->repository->getModelName();
    }

    /**
     * @return mixed
     */
    protected function getStoreFormRequest(): object
    {
        $formRequest = 'App\Http\Requests\\'.$this->getModelName().'StoreRequest';

        return new $formRequest();
    }

    /**
     * @return mixed
     */
    protected function getUpdateFormRequest(): object
    {
        $formRequest = 'App\Http\Requests\\'.$this->getModelName().'UpdateRequest';

        return new $formRequest();
    }

    /**
     * @param $items
     * @return void
     */
    protected function setDataAdditionalManipulation($items): void
    {
        //
    }
}
