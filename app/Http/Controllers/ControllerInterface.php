<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface ControllerInterface
 */
interface ControllerInterface
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function storeImage(Request $request, $id): JsonResponse;

    /**
     * @param $id
     * @return JsonResponse|BinaryFileResponse
     */
    public function getImage($id): JsonResponse|BinaryFileResponse;

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function restore(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse;
}
