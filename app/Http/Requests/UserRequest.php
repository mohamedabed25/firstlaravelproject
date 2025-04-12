<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => 'required|min:6',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            "role" => "required|in:admin,user",

        ];
    }
    public function messages(): array
    {
        return [
            'username.max' => 'Username must not exceed 255 characters.',
            'username.required' => 'Username is required1.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email already exists.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            // 'photo.image' => 'The photo must be an image.',
            // 'photo.mimes' => 'The photo must be a JPEG, PNG, or JPG file.',
            // 'photo.max' => 'The photo size must not exceed 2MB.',
            // 'photo.required' => 'Photo is required.',
            "role.required" => "Role is required.",
            "role.in" => "Role must be either admin or user."
            
            
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
