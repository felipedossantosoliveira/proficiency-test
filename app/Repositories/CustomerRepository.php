<?php

namespace App\Repositories;

use App\Models\Customer;

/**
 * Class CustomerRepository
 */
class CustomerRepository extends BaseRepository
{
    /**
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }
}
