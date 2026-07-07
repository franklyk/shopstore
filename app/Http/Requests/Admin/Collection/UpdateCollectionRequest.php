<?php

namespace App\Http\Requests\Admin\Collection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCollectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'year' => ['nullable', 'string', 'max:4'],

            'supplier_ids' => ['required', 'array', 'min:1'],

            'supplier_ids.*' => [
                'integer',
                Rule::exists('suppliers', 'id')
            ],
        ];
    }
}
