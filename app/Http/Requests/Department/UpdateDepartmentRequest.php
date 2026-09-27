<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $department = $this->route('department');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')
                    ->ignore($department->id),
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'slug')
                    ->ignore($department->id),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status_id' => [
                'required',
                'integer',
                Rule::exists('statuses', 'id')
                    ->where(fn($query) => $query->where('domain', 'department')),
            ],
        ];
    }
}
