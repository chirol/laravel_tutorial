@extends('layout')
@section('content')
<div class="container">
    <div class="panel panel-default">
    <div class="panel-heading">タスク</div>
    <div class="panel-body">
        <div class="text-right">
        <a href="{{ route('create') }}" class="btn btn-default btn-block">
            タスクを追加する
        </a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
        <th>タイトル</th>
        <th>状態</th>
        <th>期限</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($todos as $todo)
            <tr>
            <td>{{ $todo->title }}</td>
            <td>
                <span class="label {{ $todo->Doneflag_class }}">{{ $todo->doneflag_label }}</span>
            </td>
            <td>{{ $todo->due_date->format('Y/m/d') }}</td> <!--formatが冗長かも-->
            <td><a href="{{ route('edit', ['id' => $todo->id]) }}">編集</a></td>
            <td><a href="{{ route('delete', ['id' => $todo->id]) }}">削除 </a></td>           
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
    
@endsection