<?php

namespace App\Http\Controllers;

use App\Enums\SexEnum;
use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function search(): JsonResponse
    {
        $limit = request()->query('limit', 15);
        $search = request()->query('search', '');
        $searchBy = request()->query('searchBy', 'name');
        $cityId = request()->query('cityId', null);

        $customers = Customer::whereRaw("unaccent(CAST(".$searchBy." AS TEXT)) ilike unaccent('%".$search."%')");

        if (isset($cityId)) {
            $customers = $customers->where('city_id', $cityId);
        }

        $customers = $customers->paginate($limit);

        return response()->json($customers);
    }


    public function store(CustomerStoreRequest $request): JsonResponse
    {
        $customer = Customer::create($request->validated());

        $customer->load('city:id,name,state_id');
        $customer->city->load('state:id,name');

        $customer['sex'] = SexEnum::optionById($customer->sex_enum);

        return response()->json($customer, 201);
    }
}
