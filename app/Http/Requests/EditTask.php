<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\todo;

class EditTask extends CreateTask
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();

        $done_flag_rule = Rule::in(array_keys(todo::DONE_FLAG));

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

        // array_mapと無名関数を使ってtodoモデルのDONE_FLAGの'label'の配列を作成
        $status_labels = array_map(function($item){
            return $item['label'];
        }, todo::DONE_FLAG); 

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には' . $status_labels . 'のいずれかを選択してください',
        ];

    }
}
