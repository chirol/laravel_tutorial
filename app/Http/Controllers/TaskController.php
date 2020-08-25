<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\EditTaskRequest;
use App\Http\Requests\SearchTaskRequest;
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
    public function create(){

        return view('todos/create');
    }

    /**
     * 一覧表示画面での検索機能
     */
    public function search(SearchTaskRequest $request)
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
    public function store(CreateTaskRequest $request){

        // モデルのインスタンスを作成
        $todo = new Todo();

        // formからバリデーションされた値を受け取りインスタンスにセット
        $todo->title = $request->title;
        $todo->body  = $request->body;
        $todo->due_date = $request->due_date;


        Auth::user()->todos()->save($todo);
        // インスタンスの状態をデータベースに保存
        $todo->save();

        return redirect()->route('todo.index');
    }

    /**
     * タスク編集のためのフォームを呼び出す
     */
    public function edit(int $id)
    {
        // 編集対象のtodoモデル呼び出し
        $todo = Todo::find($id);

        // 編集テンプレートにモデル情報を渡す
        return view('todos/edit', [
            'todo' => $todo,
        ]);
    }

    /**
     * フォームから受け取った情報をもとにデータベースに書き込む（タスク編集機能）
     */
    public function update(int $id, EditTaskRequest $request)
    {
        $todo = Todo::find($id);

        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->due_date = $request->due_date;
        $todo->done_flag = $request->done_flag;
        $todo->save();

        return redirect()->route('todo.index');
    }

    /**
     * Todoの削除機能
     */
    public function destroy(int $id)
    {
        $todo = Todo::find($id);

        $todo->delete();

        return redirect()->route('todo.index');
    }

    /**
     * Todoの詳細表示機能
     */
    public function show($todo)
    {  
        $todo = todo::find($todo);

        return view('todos/show', ['todo' => $todo]);
    }
}
