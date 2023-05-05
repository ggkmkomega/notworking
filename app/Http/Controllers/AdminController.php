<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if($request->search)
        {
            $request->flash();
            $searching = true;
            $admins = Admin::where('fname', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('lname', 'LIKE', '%' . $request->search . '%')
                            ->paginate(15);
            if($admins->isNotEmpty()){
                $isFound = true;
                return view('admin.account.admin.index', compact('searching', 'isFound', 'admins'));
            }else{
                $isFound = false;
                return view('admin.account.admin.index', compact('searching','isFound'));
            }
        }else{
            $searching = false;
            $admins = Admin::paginate(15);
            return view('admin.account.admin.index', compact('searching', 'admins'));    
        }

    }

    public function edit(Admin $admin)
    {   
        return view('admin.account.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->flash();

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $admin->fname = $validated['fname'];
        $admin->lname = $validated['lname'];
        $admin->company = $validated['company'];
        $admin->country = $validated['country'];
        $admin->city = $validated['city'];
        $admin->zip = $validated['zip'];
        $admin->adress = $validated['adress'];
        $admin->phone = $validated['phone'];
        $admin->email = $validated['email'];
        $admin->save();
        
        return redirect(route('admins.index'));
    }

    public function show(Admin $admin)
    {
        return view('admin.account.admin.show', compact('admin'));
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect(route('admins.index'));
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'authname' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|max:255',
        ]);
        

        Admin::create([
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'authname' => $validated['authname'],
            'role' => $validated['role'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect(route('admins.index'));
    }
}
