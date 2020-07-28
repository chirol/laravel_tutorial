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
        <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($todos as $todo)
            <tr>
            <td><a href="{{ route('show', ['id' => $todo->id]) }}">{{ $todo->title }}</a></td>
            <td>
                <span class="label {{ $todo->Doneflag_class }}">{{ $todo->doneflag_label }}</span>
            </td>
            <td>{{ $todo->due_date->format('Y/m/d') }}</td> <!--formatが冗長かも-->
            <td><a class="btn btn-primary" href="{{ route('edit', ['id' => $todo->id]) }}">編集</a></td>
            <td>
                <form action="{{ route('delete', ['id' => $todo->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-secondary" type="submit" value="削除">
                </form>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
    
@endsection