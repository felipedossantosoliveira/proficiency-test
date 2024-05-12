<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 */
interface RepositoryInterface
{
    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;

    /**
     * @param array $data
     * @param Model $model
     * @return Model
     */
    public function storeImage(array $data, Model $model): Model;

    /**
     * @param Model $model
     * @return ?string
     */
    public function hasImage(Model $model): ?string;

    /**
     * @param array $data
     * @param Model $model
     * @return Model
     */
    public function update(array $data, Model $model): Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool;

    /**
     * @param $data
     * @param $limit
     * @return object
     */
    public function search($data, $limit): object;

    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @return string
     */
    public function getModelName(): string;

    /**
     * @param Model $model
     * @return bool
     */
    public function restore(Model $model): bool;

}
