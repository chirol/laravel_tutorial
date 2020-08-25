<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Todo;

class EditTaskRequest extends CreateTaskRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();

        $done_flag_rule = Rule::in(array_keys(Todo::DONE_FLAG));

        return $rule + [
            'done_flag' => 'required|' . $done_flag_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
        'done_flag' => '実施状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        // array_mapと無名関数を使ってTodoモデルのDONE_FLAGの'label'の配列を作成
        $status_labels = array_map(function($item){
            return $item['label'];
        }, Todo::DONE_FLAG); 

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には' . $status_labels . 'のいずれかを選択してください',
        ];

    }
}
