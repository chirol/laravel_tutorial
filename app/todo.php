<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
    /**
     * Todoのモデル
     */


    // protectedな配列に日付形式のカラムを追加するとbladeで->format()が使える…???
    protected $dates =[
        'due_date',
    ];

    /**
    *着手状態の定義
    */
    const DONE_FLAG =[
        0 => [ 'label' => '完了' , 'class' => ''],
        1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
    ];

    /**
    * 着手状態(done_flag)を日本語の文字列に変換して返すメソッド
    *
    * @return string 着手状態
    */
    public function getDoneflagLabelAttribute(){

        // 着手状態の取得
        $done_flag = $this->attributes['done_flag'];

        // セットされていなければ空文字を返す
        if (!isset(self::DONE_FLAG[$done_flag])){
            return '';
        }

        return self::DONE_FLAG[$done_flag]['label'];
    }

    /**
     * 状態によってラベルの色を変更するメソッド
     * 
     * @return string 着手状態に紐付けられたラベルの色(class)
     */
    public function getDoneflagClassAttribute(){

        // 着手状態の取得
        $done_flag = $this->attributes['done_flag'];

        // セットされていなければ空文字を返す
        if (!isset(self::DONE_FLAG[$done_flag])){
            return '';
        }

        return self::DONE_FLAG[$done_flag]['class'];
    }
}