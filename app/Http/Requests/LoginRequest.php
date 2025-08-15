<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
             
             'username' => 'required|username',
             //'email' => 'required|email',
            'password' => 'required|string|min:5',
        
        ];
    }
        public function messages()
    {
        return [
            'username.required' => 'Bạn bắt buộc phải nhập Email',
            //'username.email' => 'Email không đúng định dạng',
            'password.required' => 'Bạn bắt buộc phải nhập password',
            //...
        ];
    }
    }
