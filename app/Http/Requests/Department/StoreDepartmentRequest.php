<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:departments,name',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:departments,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status_id' => [
                'required',
                'integer',
                Rule::exists('statuses', 'id')
                    ->where(fn ($query) => $query->where('domain', 'department')),
            ],
        ];
    }
}
