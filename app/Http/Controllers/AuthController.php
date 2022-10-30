<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        return redirect()->intended('/shopping_list/list');
        
    }
    
    /**
     * logout method
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->regenerate();
        return redirect('/');
    }
}