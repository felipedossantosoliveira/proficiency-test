<?php

namespace App\Services;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface ServiceInterface
 */
interface ServiceInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array;

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function storeImage(Request $request, $id): array;

    /**
     * @param $id
     * @return array|BinaryFileResponse
     */
    public function getImage($id): array|BinaryFileResponse;

    /**
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function update(Request $request, int $id): array;

    /**
     * @param int $id
     * @return array
     */
    public function destroy(int $id): array;

    /**
     * @param int $id
     * @return array
     */
    public function restore(int $id): array;

    /**
     * @param Request $request
     * @return array
     */
    public function search(Request $request): array;

    /**
     * @return string
     */
    public function getModelName(): string;
}
