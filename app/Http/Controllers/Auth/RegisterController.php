<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); //ミドルウェアが何をしているか HTTPリクエストをフィルタリングして、ユーザーが誰かを判断している。
        // ログインしているユーザーauthがログインしようとしたらログインコントローラのミドルウェアはguestに指定しているので、ログインコントローラは実行されない
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [ //validatorインスタンスを生成
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', //uniqueで、emailが一意であることを確認している。 //どこに対して一意なのか->usersテーブルのemailカラムに対して
            'password' => 'required|string|min:6|confirmed', //confirmedで、フィールド名＋_confirmationフィールドと同じ値であることをバリデートします。
        ]);
        // makeメソッドの第一引数は、バリデーションを行うデータ。第二引数はそのデータに適用するバリデーションルール。
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([ //モデルクラスのcreateメソッドを呼び出している
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
