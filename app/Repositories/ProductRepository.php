<?php

namespace App\Repositories;

use App\Models\Product;

/**
 * Class ProductRepository
 */
class ProductRepository extends BaseRepository
{
    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
