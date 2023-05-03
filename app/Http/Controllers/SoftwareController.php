<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Software;
use App\Models\ProdImage;
use Illuminate\Support\Facades\Storage;

class SoftwareController extends Controller
{
    public function index()
    {
        $softwares = Software::paginate(4);
        
        return view('admin.product.software.index', compact('softwares'));    
    }

    public function siteIndex()
    {
        $softwares = Software::all();

        $categories = array();

        foreach($softwares as $item){
            if(!in_array($item->category, $categories))
            {
                $categories[] = $item->category;
            }
        }
        
        return view('display.software.index', compact('softwares', 'categories'));    
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
            'payment' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
        ]);
        $software = new Software();
        $software->prod_category = 'software';
        $software->name = $validated['name'];
        $software->header = $validated['header'];
        $software->desc = $validated['desc'];
        $software->payment = $validated['payment'];
        $software->price = $validated['price'];
        $software->category = $validated['category'];
        $software->save();
        
        if ($request->file('imgs')){
            foreach($request->file('imgs') as $img)
            {
                //store the file to the public local storag
                $imgName = time().rand(1,999).'.'.$img->extension();
                $path = $img->storeAs('images/products/' . $software->id .'_' . $software->prod_category . '_' . 'imgs', $imgName, 'public');

                //store a path to the db
                $prodImage = new ProdImage;
                $prodImage->prod_id = $software->id;
                $prodImage->prod_category = 'software';
                $prodImage->path = $path;
                $prodImage->save();
            }
        }
        
        return redirect(route('softwares.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Software $software)
    {
        $content = $software->prod_images()->get();

        return view('admin.product.software.show', compact('software', 'content'));
    }

    public function siteShow(Software $software)
    {
        $content = $software->prod_images()->get();

        return view('display.software.show', compact('software', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Software $software)
    {   

        $content = $software->prod_images()->get();
        return view('admin.product.software.edit', compact('software', 'content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Software $software)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'header' => 'required|string|max:255',
            'desc' => 'required',
            'payment' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
        ]);

        if ($request->file('imgs')){
            foreach($request->file('imgs') as $img)
            {
                //store the file to the public local storag
                $imgName = time().rand(1,999).'.'.$img->extension();
                $path = $img->storeAs('images/products/' . $software->id .'_' . $software->prod_category . '_' . 'imgs', $imgName, 'public');

                //store a path to the db
                $prodImage = new ProdImage;
                $prodImage->prod_id = $software->id;
                $prodImage->prod_category = 'software';
                $prodImage->path = $path;
                $prodImage->save();
            }
        }

        $software->name = $validated['name'];
        $software->header = $validated['header'];
        $software->desc = $validated['desc'];
        $software->payment = $validated['payment'];
        $software->price = $validated['price'];
        $software->category = $validated['category'];
        $software->save();
        
        return redirect(route('softwares.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Software $software)
    {
        $dir = ('images/products/' . $software->id .'_' . $software->prod_category . '_' . 'imgs');
        error_log($dir);
        Storage::disk('public')->deleteDirectory($dir);
        foreach ($software->prod_images()->get() as $imgitem){
            $imgitem->delete();
        }
        $software->delete();
        return redirect(route('softwares.index'));
    }

    public function deleteImg(Software $software, ProdImage $img)
    {
        error_log("deleted" . $img->path);
        Storage::disk('public')->delete($img->path);
        $img->delete();
        return redirect(route('softwares.edit', $software));
    }
}
