<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\RedirectResponse;


class AdminAuthController extends Controller
{
    public function login()
    {
        
        if(Auth::guard('admin')->check()){
            return redirect("cp");
        }
        return view('admin.auth.login');
    }

    public function admLogin(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $name = $request->name;
        $password = $request->password;

        if (Auth::guard('admin')->attempt(['name' => $name, 'password' => $password])) {
            error_log("auth");
            $request->session()->regenerate();
            return redirect()->intended('cp')->withSuccess('Signed in');
        }
        error_log("not auth");
        return redirect("cp/login")->withErrors('Login details are not valid');
    }

    public function controlPanel()
    {
        return view('admin.control-panel');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('cp/login');
    }
}
