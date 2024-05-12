<?php

namespace App\Services;

use App\Enums\SexEnum;
use App\Repositories\CustomerRepository;

/**
 * Class CustomerService
 */
class CustomerService extends BaseService
{
    /**
     * @param CustomerRepository $repository
     */
    public function __construct(CustomerRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param $items
     * @return void
     */
    protected function setDataAdditionalManipulation($items): void
    {
        foreach ($items as $item) {
            $item->sex = SexEnum::optionById($item->sex_enum);
        }
    }
}
