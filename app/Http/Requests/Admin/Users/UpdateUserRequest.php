<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                "unique:users,email,{$this->user->id}",
            ],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],

            'status_id' => [
                'required',
                'integer',
                Rule::exists('statuses', 'id')
                    ->where(fn($query) => $query->where('domain', 'user')),
            ],
        ];
    }
}
