<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Interface ServiceInterface
 */
interface ServiceInterface
{
    /**
     * @param Request $request
     * @return Model
     */
    public function store(Request $request): Model;

    /**
     * @param Request $request
     * @param int $id
     * @return Model
     */
    public function update(Request $request, int $id): Model;

    /**
     * @param int $id
     * @return bool|string
     */
    public function destroy(int $id): bool|string;

    /**
     * @param Request $request
     * @return object
     */
    public function search(Request $request): object;

    /**
     * @return string
     */
    public function getModelName(): string;
}
