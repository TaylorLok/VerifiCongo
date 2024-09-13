<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required|string|exists:users,email_verification_token',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'A verification token is required.',
            'token.exists' => 'Invalid verification token.',
            'token.string' => 'The verification token must be a string.',
        ];
    }
}