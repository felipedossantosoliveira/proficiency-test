<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductUpdateRequest
 */
class ProductUpdateRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'description' => 'exclude_if:nullable,name|min:3|max:255',
            'price' => 'exclude_if:nullable,price|numeric|min:0.01',
            'customer_id' => 'exclude_if:nullable,customer_id|exists:customers,id',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'description' => 'Descrição',
            'price' => 'Preço',
            'customer_id' => 'Cliente',
        ];
    }

}
