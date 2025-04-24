<?php

namespace App\Http\Controllers\Backend\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('auth:admin')->only('logout');
    }

    public function showLoginForm()
    {
        return view('backend.admin.auth.login');
    }

    public function loginCheck(AdminLoginRequest $req){
        $credentials = $req->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            session('success', 'Login successfully');
            return redirect()->route('admin.dashboard');
        }else{
            session('error', 'Invalid password');
            return redirect()->route('admin.login')->withInput();
        }

    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
