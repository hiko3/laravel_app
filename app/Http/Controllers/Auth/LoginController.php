<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $maxAttempts = 3; //ログイン試行回数

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';
    // ログイン後のリダイレクト先

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); // ミドルウェアはHTTPリクエストをフィルタリングする
        // ログインcontrollerが実行される時、middlewareをguestにする
        // 理由は、ログイン中ユーザーに再度ログイン画面が表示されないようにするため
        // guest(ログインしていないユーザー)がログアウトすることはないので、logoutの時は、except()で、middlewareのguestを外す
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
