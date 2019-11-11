@extends ('layouts.app') 
{{-- @extendsでlayoutsフォルダの中にあるapp.blade.phpを継承する --}}
@section ('content')
{{-- @sectionで＠extendsで継承したapp.blade.php内の@yield('content')部分に、@endsectionまでの記述を表示させる --}}

<h1 class="page-header">{{ $user->name }}のToDo一覧</h1>
<p class="text-right">
  <a class="btn btn-success" href="/todo/create">新規作成</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>ID</th>
      <th>やること</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo) <?php // foreachで$todosに入っているtodoオブジェクトをから1つずつ$todoに代入してループさせる?>
     <?php //dd($todos); ?> 
      <tr>
        <td class="align-middle">{{ $todo->id }}</td>
        <td class="align-middle">{{ $todo->title }}</td>  <?php // $todo->プロパティ（カラム名）とすることでその値を取得して表示している。?>
        <td class="align-middle">{{ $todo->created_at }}</td>
        <td class="align-middle">{{ $todo->updated_at }}</td>
        <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td>　
        <?php // 編集ボタンのリンク先　routeメソッドで指定、第一引数は名前つきルート(todo.edit)の指定、第二引数でレコードのidをルートパラメータとして送っている。?>
        <td>
          {!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection