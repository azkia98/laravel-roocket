<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
                'type' => 'required',
                'body' => 'required',
                'images' => 'required|mimes:jpeg,png,bmp',
                'price' => 'required',
                'tags' => 'required',
            ];
        }

        return [
            'title' => 'required|max:250',
            'type' => 'required',
            'body' => 'required',
            'price' => 'required',
            'tags' => 'required',
        ];
    }
}
