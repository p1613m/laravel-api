<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required|max:500',
            'content' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
        ];
    }
}
