<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'description' => ['nullable', 'string'],

            'price' => ['required', 'numeric', 'min:0'],

            'stock' => ['required', 'integer', 'min:0'],

            'categories' => ['required', 'array', 'min:1'],

            'categories.*' => [
                'integer',
                'distinct',
                Rule::exists('categories', 'id')
                    ->whereNull('parent_id') // só permite categorias FILHAS (recomendado)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'categories.required' => 'Selecione pelo menos uma categoria.',
            'categories.min' => 'Selecione pelo menos uma categoria.',
            'categories.*.exists' => 'Uma das categorias selecionadas é inválida.',
        ];
    }
}