<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'regex:/^[0-9]{6}$/',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Informe o código de verificação.',
            'code.regex' => 'O código deve conter exatamente 6 dígitos.',
        ];
    }
}
