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

            'supplier_id' => [
                'required',
                'integer',
                Rule::exists('suppliers', 'id'),
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

            'name.required' =>
                'Informe o nome do produto.',

            'name.max' =>
                'O nome do produto não pode ter mais de 255 caracteres.',

            'price.required' =>
                'Informe o preço do produto.',

            'price.numeric' =>
                'O preço deve ser um valor numérico.',

            'price.min' =>
                'O preço não pode ser negativo.',

            'brand_id.required' =>
                'Selecione uma marca.',

            'brand_id.exists' =>
                'A marca selecionada é inválida.',

            'status_id.required' =>
                'Selecione um status.',

            'status_id.exists' =>
                'O status selecionado é inválido.',

            'supplier_id.required' =>
                'Selecione um fornecedor.',

            'supplier_id.exists' =>
                'O fornecedor selecionado é inválido.',

            'categories.required' =>
                'Selecione pelo menos uma categoria.',

            'categories.min' =>
                'Selecione pelo menos uma categoria.',

            'categories.*.exists' =>
                'Uma das categorias selecionadas é inválida.',

            'collection_id.required' =>
                'Selecione uma coleção.',

            'collection_id.exists' =>
                'A coleção selecionada é inválida.',
        ];
    }
}
