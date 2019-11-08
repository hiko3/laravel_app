@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
<!-- フォームファサード　 laravelcollective/htmlをインストールすると使える {{}}はechoとエスケープ処理 -->
{!! Form::open(['route' => 'todo.store']) !!} <?php // 名前つきルートを指定 ?>
<!-- Route:listのnameがtodo.storeの対象アクションのメソッドが使用される -->
  <div class="form-group">
    {!! Form::input('text', 'title', NULL, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}

@endsection