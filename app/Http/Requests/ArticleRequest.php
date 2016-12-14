<?php

namespace App\Http\Requests;

//use Illuminate\Foundation\Http\FormRequest;
use Dingo\Api\Http\FormRequest;

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
        $rules = [
            'title' => 'required',
        ];

        return $rules;
    }

    /**
     * Validation rules => error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '文章标题不能为空',
        ];
    }
}
