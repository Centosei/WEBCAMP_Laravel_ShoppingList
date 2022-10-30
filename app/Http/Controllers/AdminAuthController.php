<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * トップページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index');
    }
    
    /**
     * authenticate login request
     * 
     */
    public function login(AdminLoginPostRequest $request)
    {
        // validation
        $datum = $request->validated();
        // auth
        if (!Auth::guard('admin')->attempt($datum))
        {
            return back()->withInput()->withErrors(['auth' => 'IDかパスワードに誤りがあります'],);
        }
        $request->session()->regenerate();
        return redirect()->intended('/admin/top');
        
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
        return redirect('/admin');
    }
}