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

            'image' => [
                'nullable',
                'image',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'brand_id' => [
                'required',
                'integer',
                Rule::exists('brands', 'id'),
            ],

            'status_id' => [
                'required',
                'integer',
                Rule::exists('statuses', 'id')
                    ->where('domain', 'product'),
            ],

            'categories' => [
                'required',
                'array',
                'min:1',
            ],

            'categories.*' => [
                'integer',
                'distinct',
                Rule::exists('categories', 'id')
                    ->whereNotNull('parent_id'),
            ],

            'collection_id' => [
                'required',
                'integer',
                Rule::exists('collections', 'id'),
            ],
        ];
    }

    public function messages(): array
    {
        return [

            'categories.required' =>
            'Selecione pelo menos uma categoria.',

            'categories.min' =>
            'Selecione pelo menos uma categoria.',

            'categories.*.exists' =>
            'Uma das categorias selecionadas é inválida.',

            'collections.required' =>
            'Selecione pelo menos uma coleção.',

            'collections.min' =>
            'Selecione pelo menos uma coleção.',

            'collections.*.exists' =>
            'Uma das coleções selecionadas é inválida.',
        ];
    }
}
