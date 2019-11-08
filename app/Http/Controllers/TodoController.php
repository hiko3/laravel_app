<?php

namespace App\Http\Controllers;
// ファイルの居場所を示す

use Illuminate\Http\Request;
use App\Todo;
use Auth;
// 使うクラスを宣言する。エイリアス（別名）でパスの記述を短くできる。

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $instanceClass)
    // コンストラクタとはクラスからインスタンスを生成するとき（オブジェクトがnewによって作成されるとき）に自動的に呼び出されるメソッド
    // モデルのクラスTodoをインスタンス化したものを$instanceClassに代入している
    {
        // dd($instanceClass);
        $this->middleware('auth');
        $this->todo = $instanceClass;
        // TodoControllerクラスのtodoに$instanceClass(モデルのクラスTodoをインスタンス化したもの)を代入している
        // 関数内で定義した変数は関数の外で使うことはできないので$this->todoに格納して外で使えるようにしている
        // $this->todoは、Todocontrollerクラスに存在する private $todo にアクセスしている。
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->todo->getByUserId(Auth::id());
        return view('todo.index', compact('todos'));
        // return view('todo.index', ['todos'=>$todos]);
        // viewメソッドの第一引数で表示させたいviewを指定、第二引数でviewに値を受け渡す処理
        // compact()は変数名とその値から連想配列を作成する
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
        // viewへルパ関数で表示させたいviewのファイルパスを指定して、returnしている。
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // Requestクラスのインスタンスをサービスプロバイダにより自動生成
    // $requestインスタンスにリクエストされた値を格納
    {
        $input = $request->all();
        $input['user_id'] = Auth::id(); // Auth::id()で現在認証されているユーザーのID取得
        $this->todo->fill($input)->save();
        // $this->todo->title = $request->title;
        // fill()を使うと、モデルの$fillableで指定したカラムと同じ名前のリクエストデータの属性の値を$inputから取得して、インスタンスに代入してくれる
        return redirect()->to('todo');
        // リダイレクト処理、toの引数でパス（’todo’）を指定。
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = $this->todo->find($id);  //find($id)で引数$idに渡ってきたidのレコードを取得
        return view('todo.edit', compact('todo'));
        // return view('todo.edit', ['todo' => $this->todo->find($id)];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->todo->find($id)->fill($input)->save();
        // $todo = $this->todo->find($id);
        // $todo->fill($input)->save();

        return redirect()->to('todo'); // redirect()は別のリクエストへGETリクエストを出し、そのリクエストによってviewを表示させている。
    }

    /**->id
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todo->find($id)->delete();
        return redirect()->to('todo');
    }
}
