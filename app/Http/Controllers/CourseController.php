<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\ProdImage;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        
        return view('admin.product.course.index', compact('courses'));
    }

    public function siteIndex()
    {
        $courses = Course::all();

        $categories = array();

        foreach($courses as $item){
            if(!in_array($item->category, $categories))
            {
                $categories[] = $item->category;
            }
        }
        
        return view('display.course.index', compact('courses', 'categories'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'header' => 'required|string|max:255',
            'desc' => 'required',
            'period' => 'required|string|max:255',
            'prof' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
        $course = new Course();
        $course->prod_category = 'course';
        $course->name = $validated['name'];
        $course->category = $validated['category'];
        $course->header = $validated['header'];
        $course->desc = $validated['desc'];
        $course->period = $validated['period'];
        $course->prof = $validated['prof'];
        $course->price = $validated['price'];
        $course->save();
        
        if ($request->file('imgs')){
            foreach($request->file('imgs') as $img)
            {
                //store the file to the public local storag
                $imgName = time().rand(1,999).'.'.$img->extension();
                $path = $img->storeAs('images/products/' . $course->id .'_' . $course->prod_category . '_' . 'imgs', $imgName, 'public');

                //store a path to the db
                $prodImage = new ProdImage;
                $prodImage->prod_id = $course->id;
                $prodImage->prod_category = 'course';
                $prodImage->path = $path;
                $prodImage->save();
            }
        }
        
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $content = $course->prod_images()->get();

        return view('admin.product.course.show', compact('course', 'content'));
    }

    public function siteShow(Course $course)
    {
        $content = $course->prod_images()->get();

        return view('display.course.show', compact('course', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {   

        $content = $course->prod_images()->get();
        return view('admin.product.course.edit', compact('course', 'content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'header' => 'required|string|max:255',
            'desc' => 'required',
            'period' => 'required|string|max:255',
            'prof' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        if ($request->file('imgs')){
            foreach($request->file('imgs') as $img)
            {
                //store the file to the public local storag
                $imgName = time().rand(1,999).'.'.$img->extension();
                $path = $img->storeAs('images/products/' . $course->id .'_' . $course->prod_category . '_' . 'imgs', $imgName, 'public');

                //store a path to the db
                $prodImage = new ProdImage;
                $prodImage->prod_id = $course->id;
                $prodImage->prod_category = 'course';
                $prodImage->path = $path;
                $prodImage->save();
            }
        }

        $course->name = $validated['name'];
        $course->category = $validated['category'];
        $course->header = $validated['header'];
        $course->desc = $validated['desc'];
        $course->period = $validated['period'];
        $course->prof = $validated['prof'];
        $course->price = $validated['price'];
        $course->save();
        
        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $dir = ('images/products/' . $course->id .'_' . $course->prod_category . '_' . 'imgs');
        error_log($dir);
        Storage::disk('public')->deleteDirectory($dir);
        foreach ($course->prod_images()->get() as $imgitem){
            $imgitem->delete();
        }
        $course->delete();
        return redirect(route('courses.index'));
    }

    public function deleteImg(course $course, ProdImage $img)
    {
        error_log("deleted" . $img->path);
        Storage::disk('public')->delete($img->path);
        $img->delete();
        return redirect(route('courses.edit', $course));
    }
}
