<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update authorization logic if needed
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255|min:1',
            'content' => 'sometimes|string|min:1',
            'image' => 'nullable|image|max:2048'
        ];
    }
}