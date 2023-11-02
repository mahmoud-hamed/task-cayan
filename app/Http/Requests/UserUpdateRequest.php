<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email,' . $this->route('user'), // Ignore the current user's email
            'password' => 'nullable|min:6', // Make the password optional
            'first_name' => 'nullable|string', // First name field
            'last_name' => 'nullable|string',  // Last name field
            'salary' => 'nullable|numeric',  // Salary field
        ];
    }
    
}
