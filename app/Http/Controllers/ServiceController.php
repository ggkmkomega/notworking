<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ProdImage;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if($request->search)
        {
            $request->flash();
            $searching = true;
            $services = Service::where('name', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('header', 'LIKE', '%' . $request->search . '%')
                            ->paginate(4);
            if($services->isNotEmpty()){
                $isFound = true;
                return view('admin.product.service.index', compact('searching', 'isFound', 'services'));
            }else{
                $isFound = false;
                return view('admin.product.service.index', compact('searching','isFound'));
            }
        }else{
            $searching = false;
            $services = Service::paginate(4);
            return view('admin.product.service.index', compact('searching', 'services'));    
        }

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
            'page' => 'required',
        ]);
        $service = new Service();
        $service->prod_category = 'service';
        $service->name = $validated['name'];
        $service->header = $validated['header'];
        $service->desc = $validated['desc'];
        $service->page = $validated['page'];
        $service->save();
        
        if ($request->file('imgs')){
            foreach($request->file('imgs') as $img)
            {
                //store the file to the public local storag
                $imgName = time().rand(1,999).'.'.$img->extension();
                $path = $img->storeAs('images/products/' . $service->id .'_' . $service->prod_category . '_' . 'imgs', $imgName, 'public');

                //store a path to the db
                $prodImage = new ProdImage;
                $prodImage->prod_id = $service->id;
                $prodImage->prod_category = 'service';
                $prodImage->path = $path;
                $prodImage->save();
            }
        }
        
        return redirect(route('services.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $content = $service->prod_images()->get();

        return view('admin.product.service.show', compact('service', 'content'));
    }
    
    public function siteShow(Service $service)
    {
        $content = $service->prod_images()->get();

        return view('display.service.show', compact('service', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {   

        $content = $service->prod_images()->get();
        return view('admin.product.service.edit', compact('service', 'content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'header' => 'required|string|max:255',
            'desc' => 'required',
            'page' => 'required',
        ]);

        if ($request->file('imgs')){
            foreach($request->file('imgs') as $img)
            {
                //store the file to the public local storag
                $imgName = time().rand(1,999).'.'.$img->extension();
                $path = $img->storeAs('images/products/' . $service->id .'_' . $service->prod_category . '_' . 'imgs', $imgName, 'public');

                //store a path to the db
                $prodImage = new ProdImage;
                $prodImage->prod_id = $service->id;
                $prodImage->prod_category = 'service';
                $prodImage->path = $path;
                $prodImage->save();
            }
        }

        $service->name = $validated['name'];
        $service->header = $validated['header'];
        $service->desc = $validated['desc'];
        $service->page = $validated['page'];
        $service->save();
        
        return redirect(route('services.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $dir = ('images/products/' . $service->id .'_' . $service->prod_category . '_' . 'imgs');
        error_log($dir);
        Storage::disk('public')->deleteDirectory($dir);
        foreach ($service->prod_images()->get() as $imgitem){
            $imgitem->delete();
        }
        $service->delete();
        return redirect(route('services.index'));
    }

    public function deleteImg(Service $service, ProdImage $img)
    {
        error_log("deleted" . $img->path);
        Storage::disk('public')->delete($img->path);
        $img->delete();
        return redirect(route('services.edit', $service));
    }
}
