<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'POST') {
            return [
                'title' => 'required|max:250',
                'description' => 'required',
                'body' => 'required',
                'images' => 'required|mimes:jpeg,png,bmp',
                'tags' => 'required',
            ];
        }

        return [
            'title' => 'required|max:250',
            'description' => 'required',
            'body' => 'required',
            'tags' => 'required',
        ];

    }
}
