<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

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
                'exists:brands,id',
            ],

            'status_id' => [
                'required',
                'integer',
                'exists:statuses,id',
            ],

            'collection_id' => [
                'required',
                'integer',
                'exists:collections,id',
            ],

            'supplier_id' => [
                'required',
                'integer',
                'exists:suppliers,id',
            ],

            'categories' => [
                'required',
                'array',
            ],

            'categories.*' => [
                'integer',
                'distinct',
                'exists:categories,id',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],

            // 'stock' => ['required', 'integer', 'min:0'],
        ];
    }
}
