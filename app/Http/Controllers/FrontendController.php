<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hardware;
use App\Models\Software;
use App\Models\Course;
use App\Models\Service;

use function PHPUnit\Framework\isEmpty;

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
}
