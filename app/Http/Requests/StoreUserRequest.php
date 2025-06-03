<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' =>     'required|string|max:255',
            'email' =>    'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' =>     ['required' , Rule::in(["admin" , "user"])],
            'image_url' =>    'nullable|image|mimes:jpeg,png,jpg,gif'
        ];
    }
}