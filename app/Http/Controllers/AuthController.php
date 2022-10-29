<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginPostRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * トップページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }
    
    /**
     * authenticate login request
     * 
     */
    public function login(UserLoginPostRequest $request)
    {
        // validation
        $datum = $request->validated();
        // auth
        if (!Auth::attempt($datum))
        {
            return back()->withInput()->withErrors(['メールアドレスかパスワードに誤りがあります'],);
        }
        $request->session()->regenerate();
        return redirect()->intended('/');
        
    }
}