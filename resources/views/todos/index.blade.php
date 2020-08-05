@extends('layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
<div class="container">
    <div class="panel panel-default">
    <div class="panel-heading">タスク</div>
    <div class="panel-body">
        @if(session('flash_message'))
            <div class="flash_message bg-success text-center py-3 my-0">
                {{session('flash_message')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
        @endif
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
            <tr>
                {{ Form::open(['action' => 'TaskController@search'], ['method' => 'post']) }}
                {{ Form::text('search_due_date', '期限日検索', ["id" => "search_due_date"])}}
                {{ Form::submit('検索')}}
                {{ Form::close() }}
            </tr>
        </tbody>
    </table>
    </div>
</div>
    
@endsection

@section('scripts')
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('search_due_date'), {
      locale: 'ja',
      dateFormat: "Y-m-d",
    });
</script>
@endsection