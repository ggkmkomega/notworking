<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hardware;
use App\Models\Software;
use App\Models\Course;
use App\Models\Service;

class FrontendController extends Controller
{
    public function searchProduct(Request $request){
        if($request->search)
        {
            $hwProductsList = Hardware::where('name', 'LIKE', '%' . $request->search . '%')->get();
            $swProductsList = Software::where('name', 'LIKE', '%' . $request->search . '%')->get();
            $crProductsList = Course::where('name', 'LIKE', '%' . $request->search . '%')->get();
            $svProductsList = Service::where('name', 'LIKE', '%' . $request->search . '%')->get();

            return view('search', compact('hwProductsList', 'swProductsList', 'crProductsList', 'svProductsList'));
        }else{
            return view('search')->with('message', 'Nothing Found');
        }
    }
}
