<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.hardware.index');
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
        $hardware->name = $request->name;
        $hardware->header = $request->header;
        $hardware->desc = $request->desc;
        $hardware->datasheet = $request->datasheet;
        $hardware->category = $request->category;
        $hardware->save();

        return redirect(route('hardwares.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Hardware $hardware)
    {
        return view('admin.product.hardware.show', compact('hardware'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hardware $hardware)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hardware $hardware)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hardware $hardware)
    {
        //
    }
}
