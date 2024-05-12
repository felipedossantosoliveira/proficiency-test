<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class BaseController
 */
abstract class BaseController implements ControllerInterface
{
    /**
     * @param BaseService $service
     */
    public function __construct(
        protected BaseService $service
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        return $this->apiResponse($this->service->store($request));
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function storeImage(Request $request, $id): JsonResponse
    {
        return $this->apiResponse($this->service->storeImage($request, $id));
    }

    /**
     * @param $id
     * @return JsonResponse|BinaryFileResponse
     */
    public function getImage($id): JsonResponse|BinaryFileResponse
    {
        return $this->apiResponse($this->service->getImage($id));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->apiResponse($this->service->update($request, $id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        return $this->apiResponse($this->service->destroy($request->id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function restore(Request $request): JsonResponse
    {
        return $this->apiResponse($this->service->restore($request->id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        return $this->apiResponse($this->service->search($request));
    }

    /**
     * @param array|BinaryFileResponse $response
     * @return BinaryFileResponse|JsonResponse
     */
    protected function apiResponse(array|BinaryFileResponse $response): BinaryFileResponse|JsonResponse
    {
        if (is_array($response)) {
            return response()->json($response, $response['status']);
        }

        return $response;
    }
}
