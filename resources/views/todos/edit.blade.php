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
            <div class="panel-heading">タスクを編集する</div>
            <div class="panel-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif
                  <form action="{{ route('todo.update', ['todo' => $todo->id])}}" method="post">
                  <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="form-group">
                  <label for="title">タスク名</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $todo->title }}" />
                </div>
                <div class="form-group">
                  <label for="done_flag">実施状態</label>
                  <select name="done_flag" id="done_flag" class="form-control">
                    <!--oldに値があったらそれを選択済みにする-->
                    @foreach(\App\Models\Todo::DONE_FLAG as $key => $val)
                      <option
                        value="{{ $key }}"
                        {{ $key == old('done_flag', $todo->done_flag) ? 'selected' : '' }}
                      >
                      {{ $val['label'] }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                    <label for="body">タスクの内容</label>
                    <input type="text" class="form-control" name="body" id="body" value="{{ old('body') ?? $todo->body }}" />
                </div>

                <div class="form-group">
                    <label for="due_date">期限日</label>
                    <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') ?? $todo->due_date }}" />
                </div>

                <div class="text-right">
                  <button type="submit" class="btn btn-primary">送信</button>
                </div>
              </form>
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
