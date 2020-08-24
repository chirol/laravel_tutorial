@extends('layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col col-md-offset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">タスク詳細</div>
            <div class="panel-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="form-group">
                  <label for="title">タスク名</label>
                  <p>{{ $todo->title }}</p>
                </div>

                <div class="form-group">
                    <label for="body">タスクの内容</label>
                    <p>{{ $todo->body }}</p>
                </div>

                <div class="form-group">
                    <label for="due_date">期限日</label>
                    <p>{{ $todo->due_date->format('Y/m/d') }}</p>
                </div>
                <div>
                <a class="btn btn-primary" href="{{ route('todo.index')}}">戻る</a>
                <form action="{{ route('todo.destroy', ['todo' => $todo->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-secondary" type="submit" value="削除">
                </form>
                </div>


            </div>
          </nav>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('due_date'), {
      locale: 'ja',
      dateFormat: "Y-m-d",
      minDate: new Date()
    });
</script>
@endsection