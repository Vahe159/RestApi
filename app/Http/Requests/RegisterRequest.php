<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|string|unique:users,phone',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];
    }
}
