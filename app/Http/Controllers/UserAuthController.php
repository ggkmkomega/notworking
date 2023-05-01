<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\RedirectResponse;

class UserAuthController extends Controller
{
    public function showRegisterForm(){
        return view('user.auth.register');
    }

    public function register(Request $request){

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'company' => 'string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|numeric',
            'adress' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|max:255',
        ]);
        

        $user = User::create([
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'company' => $validated['company'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'zip' => $validated['zip'],
            'adress' => $validated['adress'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));


        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            //auth
            $request->session()->regenerate();
            return redirect()->intended(route('main'))->withSuccess('Signed in');
        }
        
        return redirect(route('loginForm'));
    }

    public function showLoginForm(){
        return view('user.auth.login');
    }

    public function login(Request $request){

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|max:255',
        ]);

        if (Auth::attempt($validated)) {
            //auth
            $request->session()->regenerate();
            return redirect()->intended(route('main'))->withSuccess('Signed in');
        }
        
        return redirect(route('userLogin'));
    }

    public function signout() {
        Session::flush();
        Auth::logout();
  
        return redirect(route('main'));
    }
}
