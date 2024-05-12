<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        return response()->json($this->service->store($request));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($request, $id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        return response()->json($this->service->destroy($request->id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        return response()->json($this->service->search($request));
    }
}
