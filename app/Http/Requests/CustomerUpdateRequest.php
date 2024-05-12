<?php

namespace App\Http\Requests;

use App\Enums\SexEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * CustomerUpdateRequest
 */
class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules($id): array
    {
        return [
            'name' => 'exclude_if:nullable,name|min:3|max:255',
            'city_id' => 'exclude_if:nullable,city_id|exists:cities,id',
            'cpf' => [
                'exclude_if:cpf,null|size:11',
                Rule::unique('customers')->ignore($id, 'id'),
            ],
            'cep' => 'exclude_if:nullable,cep|size:8',
            'address' => 'exclude_if:nullable,address|min:3|max:255',
            'number' => 'exclude_if:nullable,number|min:1|max:100',
            'complement' => 'nullable|min:1|max:255',
            'sex_enum' => ['exclude_if:nullable,sex_enum', Rule::enum(SexEnum::class)],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nome',
            'city_id' => 'Cidade',
            'cpf' => 'CPF',
            'cep' => 'CEP',
            'address' => 'Endereço',
            'number' => 'Número',
            'complement' => 'Complemento',
        ];
    }
}
