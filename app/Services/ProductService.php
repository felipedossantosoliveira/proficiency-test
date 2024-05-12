<?php

namespace App\Services;

use App\Repositories\ProductRepository;

/**
 * Class ProductService
 */
class ProductService extends BaseService
{
    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }
}
