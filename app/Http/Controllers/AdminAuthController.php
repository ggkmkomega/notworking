<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
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
            'authname' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            //auth
            $request->session()->regenerate();
            return redirect()->intended('cp')->withSuccess('Signed in');
        }
        //not auth
        return redirect("cp/login")->withErrors('Login details are not valid');
    }

    public function controlPanel(Admin $admin)
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.control-panel', compact('admin'));
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('cp/login');
    }

    public function showProfile() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

}
