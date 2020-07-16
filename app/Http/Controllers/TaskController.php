<?php

namespace App\Http\Controllers;

use App\todo;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(){

        $todos = todo::all();

        return view('todos/index', [
            'todos' => $todos
        ]);
    }
}
