<?php

namespace App\Http\Controllers;

use App\todo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Http\Requests\SearchTask;
use Illuminate\Support\Facades\Auth;

/**
     * タスクのコントローラー
     */
class TaskController extends Controller
{
    /**
     * タスクの一覧表示
     * 
     */
    public function index()
    {
        //ユーザーモデルに紐付いているタスク一覧を取得し、実施状態と期限日でソート
        $todos = Auth::user()->todos()->orderBy('done_flag', 'DESC')->orderBy('due_date', 'ASC')->get();

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
     * 一覧表示画面での検索機能
     */
    public function search(SearchTask $request)
    {
        $search_due_date = $request->search_due_date;
        
        $todos = Auth::user()->todos()->where('due_date', '<=', $request->search_due_date)->orderBy('done_flag', 'DESC')->orderBy('due_date', 'ASC')->get();

        return view('todos/index',[
            'todos' => $todos
        ]);
    }

    /**
     * フォームから受け取った情報をもとにデータベースに書き込む（タスク作成機能）
     */
    public function create(CreateTask $request){

        // モデルのインスタンスを作成
        $todo = new todo();

        // formからバリデーションされた値を受け取りインスタンスにセット
        $todo->title = $request->title;
        $todo->body  = $request->body;
        $todo->due_date = $request->due_date;


        Auth::user()->todos()->save($todo);
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

    /**
     * フォームから受け取った情報をもとにデータベースに書き込む（タスク編集機能）
     */
    public function edit(int $id, EditTask $request)
    {
        $todo = todo::find($id);

        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->due_date = $request->due_date;
        $todo->done_flag = $request->done_flag;
        $todo->save();

        return redirect()->route('index');
    }

    /**
     * Todoの削除機能
     */
    public function destroy(int $id)
    {
        $todo = todo::find($id);

        $todo->delete();

        return redirect()->route('index');
    }

    /**
     * Todoの詳細表示機能
     */
    public function show(int $id)
    {  

        $todo = todo::find($id);

        return view('todos/show', ['todo' => $todo]);
    }
}
