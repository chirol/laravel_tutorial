<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchTaskRequest extends FormRequest
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
            'search_due_date' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'search_due_date' => '期限日'
        ];
    }

    public function messages()
    {
        return [
            'search_due_date.date' => ':attribute には日付を入力してください'
        ];
    }

}
