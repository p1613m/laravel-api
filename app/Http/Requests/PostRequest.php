<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'content' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png',
        ];
    }
}
