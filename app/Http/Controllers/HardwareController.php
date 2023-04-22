<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use App\Models\ProdImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hardwares = Hardware::all();
        
        return view('admin.product.hardware.index', compact('hardwares'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'header' => 'required|string|max:255',
            'desc' => 'required',
            'datasheet' => 'required',
            'category' => 'required|string|max:255',
        ]);
        $hardware = new Hardware;
        $hardware->prod_category = 'hardware';
        $hardware->name = $request->name;
        $hardware->header = $request->header;
        $hardware->desc = $request->desc;
        $hardware->datasheet = $request->datasheet;
        $hardware->category = $request->category;
        $hardware->save();
        
        if ($request->file('imgs')){
            foreach($request->file('imgs') as $img)
            {
                //store the file to the public local storag
                $imgName = time().rand(1,999).'.'.$img->extension();
                $path = $img->storeAs('images/products/' . $hardware->id .'_' . $hardware->prod_category . '_' . 'imgs', $imgName, 'public');

                //store a path to the db
                $prodImage = new ProdImage;
                $prodImage->prod_id = $hardware->id;
                $prodImage->prod_category = 'hardware';
                $prodImage->path = $path;
                $prodImage->save();
            }
        }
        
        return redirect(route('hardwares.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Hardware $hardware)
    {
        $content = $hardware->prod_images()->get();

        return view('admin.product.hardware.show', compact('hardware', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hardware $hardware)
    {   

        $content = $hardware->prod_images()->get();
        return view('admin.product.hardware.edit', compact('hardware', 'content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hardware $hardware)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'header' => 'required|string|max:255',
            'desc' => 'required',
            'datasheet' => 'required',
            'category' => 'required|string|max:255',
        ]);

        if ($request->file('imgs')){
            foreach($request->file('imgs') as $img)
            {
                //store the file to the public local storag
                $imgName = time().rand(1,999).'.'.$img->extension();
                $path = $img->storeAs('images/products/' . $hardware->id .'_' . $hardware->prod_category . '_' . 'imgs', $imgName, 'public');

                //store a path to the db
                $prodImage = new ProdImage;
                $prodImage->prod_id = $hardware->id;
                $prodImage->prod_category = 'hardware';
                $prodImage->path = $path;
                $prodImage->save();
            }
        }

        $hardware->name = $request->name;
        $hardware->header = $request->header;
        $hardware->desc = $request->desc;
        $hardware->datasheet = $request->datasheet;
        $hardware->category = $request->category;
        $hardware->save();
        
        return redirect(route('hardwares.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hardware $hardware)
    {
        $dir = ('images/products/' . $hardware->id .'_' . $hardware->prod_category . '_' . 'imgs');
        error_log($dir);
        Storage::disk('public')->deleteDirectory($dir);
        foreach ($hardware->prod_images()->get() as $imgitem){
            $imgitem->delete();
        }
        $hardware->delete();
        return redirect(route('hardwares.index'));
    }

    public function deleteImg(Hardware $hardware, ProdImage $img)
    {
        error_log("deleted" . $img->path);
        Storage::disk('public')->delete($img->path);
        $img->delete();
        return redirect(route('hardwares.edit', $hardware));
    }
}
