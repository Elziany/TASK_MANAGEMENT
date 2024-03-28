<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|unique:users,email' ,
            'password' => 'required|min:8|confirmed' ,
            'userName' => 'required|min:3'
        ];
    }
    public function messages()
{
    return [
        'email.required' => 'The email field is required.',
        'userName.required' => 'The user name field is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already in use.',
        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 8 characters long.',
        // Add more custom error messages for other rules...
    ];
}
 
}
