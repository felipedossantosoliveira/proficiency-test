<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;

/**
 * Class CustomerController
 */
class CustomerController extends BaseController
{
    /**
     * @param CustomerService $service
     */
    public function __construct(CustomerService $service)
    {
        parent::__construct($service);
    }
}
