<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hardware;
use App\Models\Software;
use App\Models\Course;
use App\Models\Service;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{

    public function searchProduct(Request $request){

        $isFound = false;
        if($request->search)
        {
            $isFound = true;
            $hwProductsList = Hardware::where('name', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('header', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('category', 'LIKE', '%' . $request->search . '%')
                                    ->get();

            $swProductsList = Software::where('name', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('header', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('category', 'LIKE', '%' . $request->search . '%')
                                    ->get();

            $crProductsList = Course::where('name', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('header', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('category', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('prof', 'LIKE', '%' . $request->search . '%')
                                    ->get();

            $svProductsList = Service::where('name', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('header', 'LIKE', '%' . $request->search . '%')
                                    ->get();

            if($hwProductsList->isNotEmpty() || $swProductsList->isNotEmpty() || $crProductsList->isNotEmpty() || $svProductsList->isNotEmpty() ){
                return view('search', compact('isFound', 'hwProductsList', 'swProductsList', 'crProductsList', 'svProductsList'));
            }else{
                $isFound = false;
                return view('search', compact('isFound'));
            }

        }else{
            return redirect('/')->with('message', 'error');
        }
    }

    public function showDashboard(){
        return view('user.user-dashboard');
    }

    public function accountSettings(){

        $user = Auth::user();
        return view('user.dashboard.account', compact('user'));
    }
    
    public function updateUserEmail(Request $request){
        $user = Auth::user();

        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        if($user->email != $validated['email']){

            $user->email = $validated['email'];
            $user->email_verified_at = null;
            $user->save();

            $user->SendEmailVerificationNotification();
        }

        return redirect(route('userAccountSettings'));

    }

    public function resendVerificationMail(){

        $user = Auth::user();

        if($user->email_verified_at == null){
            $user->SendEmailVerificationNotification();
        }

        return redirect(route('userAccountSettings'));

    }

    

    public function updateUserPassword(Request $request){
        $user = Auth::user();
        
        $validated = $request->validate([
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255',
        ]);

        if(Hash::check($validated['old_password'], $user->password)){
            error_log('yes');
            $user->password = Hash::make($validated['new_password']);
            $user->save();
            return redirect(route('userAccountSettings'));
        }else{
            return redirect(route('userAccountSettings'))->withErrors('password given dont match current password');
        }

    }
    

    public function updateUserInfo(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'company' => 'string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|numeric',
            'adress' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $user->fname = $validated['fname'];
        $user->lname = $validated['lname'];
        $user->company = $validated['company'];
        $user->country = $validated['country'];
        $user->city = $validated['city'];
        $user->zip = $validated['zip'];
        $user->adress = $validated['adress'];
        $user->phone = $validated['phone'];
        $user->save(); //this stupid laravel intellisense is bugged 
        
        return redirect(route('userAccountSettings'));
    }

    public function verifyEmail(){
        return view('user.dashboard.verify-email');
    }
    
}
