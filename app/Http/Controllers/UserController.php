<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->search)
        {
            $request->flash();
            $searching = true;
            $users = User::where('fname', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('lname', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('company', 'LIKE', '%' . $request->search . '%')
                            ->paginate(15);
            if($users->isNotEmpty()){
                $isFound = true;
                return view('admin.account.user.index', compact('searching', 'isFound', 'users'));
            }else{
                $isFound = false;
                return view('admin.account.user.index', compact('searching','isFound'));
            }
        }else{
            $searching = false;
            $users = User::paginate(15);
            return view('admin.account.user.index', compact('searching', 'users'));    
        }

    }

    public function edit(User $user)
    {   
        return view('admin.account.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
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
        ]);

        $user->fname = $validated['fname'];
        $user->lname = $validated['lname'];
        $user->company = $validated['company'];
        $user->country = $validated['country'];
        $user->city = $validated['city'];
        $user->zip = $validated['zip'];
        $user->adress = $validated['adress'];
        $user->phone = $validated['phone'];
        $user->email = $validated['email'];
        $user->save();
        
        return redirect(route('users.index'));
    }

    public function show(User $user)
    {
        return view('admin.account.user.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'));
    }
}
