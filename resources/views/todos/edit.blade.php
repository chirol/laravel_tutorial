<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>TODO作成</title>
</head>
<body>
    <main>
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
<!-- methodにPOSTを指定しているので、name('create')と紐付けられた複数のURLのうち、POSTで始まるものが適応される -->
              <form action="{{ route('edit'), ['id' => $id] }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="title">タスク名</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $todo->title }}" />
                </div>

                <div class="form-group">
                    <label for="body">タスクの内容</label>
                    <input type="text" class="form-control" name="body" id="body" value="{{ old('body') }}" />
                </div>

                <div class="form-group">
                    <label for="due_date">期限日</label>
                    <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
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
  </main>
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('due_date'), {
      locale: 'ja',
      dateFormat: "Y-m-d",
      minDate: new Date()
    });
</script>
</body>
</html>