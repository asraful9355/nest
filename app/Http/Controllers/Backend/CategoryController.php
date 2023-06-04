<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Session;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  $categories = Category::all();
       return view('backend.category.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name_en'=>'required',
            'category_image'=>'required',
        ]);

        if($request->hasfile('category_image')){
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(180,180)->save('upload/category/'.$name_gen);
            $category_image = 'upload/category/'.$name_gen;
        }else{
            $category_image = $request->category_images;
        }

        $category = new Category;
        $category->category_name_en = $request->category_name_en;
        if($request->category_name_bn == ''){
            $category->category_name_bn = $request->category_name_en;
        }else{
            $category->category_name_bn = $request->category_name_bn;
        }
       if($request->status == Null){
            $request->status = 0;
        }
       if($request->featured_category == Null){
            $request->featured_category = 0;
        }
        $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->category_name_en)));
        $category->status = $request->status;
        $category->category_image = $category_image;
        $category->featured_category = $request->featured_category;
        $category->created_at = Carbon::now();
        $category->save();

        Session::flash('success','Category Inserted Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
       $category = Category::find($id);
        return view('backend.category.view',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($request->hasfile('category_image')){
            try {
                if(file_exists($category->category_image)){
                    unlink($category->category_image);
                }
            } catch (Exception $e) {

            }
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(180,180)->save('upload/category/'.$name_gen);
            $category_image = 'upload/category/'.$name_gen;
        }else{
            $category_image = $category->category_image;
        }

        $category->category_name_en = $request->category_name_en;
        if($request->category_name_bn == ''){
            $category->category_name_bn = $request->category_name_en;
        }else{
            $category->category_name_bn = $request->category_name_bn;
        }
       if($request->status == Null){
            $request->status = 0;
        }
       if($request->featured_category == Null){
            $request->featured_category = 0;
        }
        $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->category_name_en)));
        $category->status = $request->status;
        $category->category_image = $category_image;
        $category->featured_category = $request->featured_category;
        $category->created_at = Carbon::now();
        $category->save();
        Session::flash('success','Category Updated Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {    $category = Category::find($id);
         $category_image = $category->category_image;
         unlink($category_image);
         $category->delete();
         Session::flash('success','Category Deleted Successfully');
         return redirect()->route('category.index');
    }

    public function active($id){
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        Session::flash('success','Category Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        Session::flash('success','Category Disabled Successfully.');
        return redirect()->back();
    }
}
