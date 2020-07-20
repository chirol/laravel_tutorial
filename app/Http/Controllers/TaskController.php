<?php

namespace App\Http\Controllers;

use App\todo;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;

    /**
     * タスクのコントローラー
     */
class TaskController extends Controller
{
    /**
     * タスクの一覧表示
     * 
     */
    public function index(){

        $todos = todo::all();

        return view('todos/index', [
            'todos' => $todos
        ]);
    }
    
    /**
     * タスク作成のためのフォームを呼び出す
     */
    public function showCreateForm(){

        return view('todos/create');
    }

    /**
     * フォームから受け取った情報をもとにデータベースに書き込む
     */
    public function create(CreateTask $request){

        // モデルのインスタンスを作成
        $todo = new todo();

        // formからバリデーションされた値を受け取りインスタンスにセット
        $todo->title = $request->title;
        $todo->body  = $request->body;
        $todo->due_date = $request->due_date;

        // インスタンスの状態をデータベースに保存
        $todo->save();

        return redirect()->route('index');
    }

    /**
     * タスク編集のためのフォームを呼び出す
     */
    public function showEditForm(int $id)
    {
        // 編集対象のtodoモデル呼び出し
        $todo = todo::find($id);

        // 編集テンプレートにモデル情報を渡す
        return view('todos/edit', [
            'todo' => $todo,
        ]);
    }

}
