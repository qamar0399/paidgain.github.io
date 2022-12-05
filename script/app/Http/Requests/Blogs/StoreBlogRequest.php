<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
        return [
            'name'          => ['required', 'string'],
            'excerpt'       => ['required', 'string'],
            'description'   => ['required', 'string'],
            'status'        => ['nullable', 'integer'],
            'featured'      => ['nullable', 'integer'],
            'lang'          => ['nullable', 'string'],
            'comment_status'=> ['nullable', 'integer']
        ];
    }
}
