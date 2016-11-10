<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->gallery;
        return [
            'title' => 'required|unique:galleries,title,'.$id.'|max:255',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required, at least fill a character',
            'title.unique' => 'Title must unique, take another title'
        ];
    }
}
