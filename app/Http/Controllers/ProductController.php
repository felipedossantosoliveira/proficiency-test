<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

/**
 * Class ProductController
 */
class ProductController extends BaseController
{
    /**
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
    }
}
