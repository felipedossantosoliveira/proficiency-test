<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
    public function store(Request $request): Model
    {
        Validator::make($request->all(), $this->getStoreFormRequest()->rules())->validate();

        return $this->repository->store($request->all());
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): Model
    {
        Validator::make($request->all(), $this->getUpdateFormRequest()->rules($id))->validate();

        return $this->repository->update($request->all(), $this->repository->getModel()->findOrFail($id));
    }

    /**
     * @param int $id
     * @return bool | string
     */
    public function destroy(int $id): bool|string
    {
        try {
            $this->repository->getModel()->findOrFail($id);
        } catch (Throwable) {
            return $this->getModelName().' not found';
        }

        return $this->repository->destroy($this->repository->getModel()->findOrFail($id));
    }

    /**
     * @param Request $request
     * @return object
     */
    public function search(Request $request): object
    {
        $limit = $request->query('limit', 15);
        $limit = $limit > 50 ? 50 : $limit;
        $search = $request->query('search', []);
        $filter = $request->query('filter', []);
        $with = $request->query('with', []);

        $data = $this->repository->getModel();

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

        return $data;
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
