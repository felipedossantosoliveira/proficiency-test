<?php

namespace App\Http\Requests;

use App\Enums\SexEnum;
use App\Rules\CpfValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CustomerStoreRequest
 */
class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'city_id' => 'required|exists:cities,id',
            'cpf' => ['required', 'size:11', 'unique:customers,cpf', new CpfValidation()],
            'cep' => 'required|size:8',
            'address' => 'required|min:3|max:255',
            'number' => 'required|min:1|max:100',
            'complement' => 'nullable|min:1|max:255',
            'sex_enum' => ['required', Rule::enum(SexEnum::class)],
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
