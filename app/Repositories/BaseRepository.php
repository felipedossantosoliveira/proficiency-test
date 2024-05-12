<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 */
abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @param Model $model
     */
    public function __construct(
        protected Model $model
    ) {
    }

    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param Model $model
     * @return Model
     */
    public function storeImage(array $data, Model $model): Model
    {
        $model->update($data);

        return $model;
    }

    /**
     * @param Model $model
     * @return ?string
     */
    public function hasImage(Model $model): ?string
    {
        return $model->photo;
    }

    /**
     * @param array $data
     * @param Model $model
     * @return Model
     */
    public function update(array $data, Model $model): Model
    {
        $model->update($data);

        return $model;
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * @param $data
     * @param $limit
     * @return object
     */
    public function search($data, $limit): object
    {
        return $data->paginate($limit);
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getModelName(): string
    {
        return class_basename($this->model);
    }

    /**
     * @param  Model  $model
     */
    public function restore($model): bool
    {
        return $model->restore();
    }
}
