<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Session;;

class SliderController extends Controller
{
      public function index(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.index',compact('sliders'));
    } // End Method 


    public function create(){
        return view('backend.slider.create');
    }

    public function store(Request $request){
        
     
        // $this->validate($request,[
        //     'slider_title_en'=>'required',
        //     'short_title_en'=>'required',
        //     'slider_image'=>'required'
        // ]);

        if($request->hasfile('slider_image')){
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
            $slider_image = 'upload/slider/'.$name_gen;
        }else{
            $slider_image = $request->slider_images;
        }

      $slider = new Slider;

       $slider->slider_title_en = $request->slider_title_en;
        if($request->slider_title_bn == ''){
            $slider->slider_title_bn = $request->slider_title_en;
        }else{
            $slider->slider_title_bn = $request->slider_title_bn;
        }
       $slider->short_title_en = $request->short_title_en;
        if($request->short_title_bn == ''){
            $slider->short_title_bn = $request->short_title_en;
        }else{
            $slider->short_title_bn = $request->short_title_bn;
        }

        if($request->status == Null){
            $request->status = 1;
        }

        $slider->status = $request->status;
        $slider->slider_image = $slider_image;
        $slider->created_at = Carbon::now();
        $slider->save();



        Session::flash('success','Slider Inserted Successfully');
        return redirect()->route('slider.index');

    }// End Method 


    public function edit($id){

        $slider = Slider::find($id);
     return view('backend.slider.edit', compact('slider'));
     } // End Edit Mathod
 
    
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request ,$id)
     {
        $slider = Slider::find($id);
 
         if($request->hasfile('slider_image')){
             try {
                 if(file_exists($slider->slider_image)){
                     unlink($slider->slider_image);
                 }
             } catch (Exception $e) {
 
             }
             $image = $request->file('slider_image');
             $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
             Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
             $slider_image = 'upload/slider/'.$name_gen;
         }else{
             $slider_image = $slider->slider_image;
         }
 
         $slider->slider_title_en = $request->slider_title_en;
         if($request->slider_title_bn == ''){
             $slider->slider_title_bn = $request->slider_title_en;
         }else{
             $slider->slider_title_bn = $request->slider_title_bn;
         }
         $slider->short_title_en = $request->short_title_en;
         if($request->short_title_bn == ''){
             $slider->short_title_bn = $request->short_title_en;
         }else{
             $slider->short_title_bn = $request->short_title_bn;
         }
 
         if($request->status == Null){
            $request->status = 0;
        }
      
         $slider->status = $request->status;
 
         $slider->slider_image = $slider_image;
 
         $slider->created_at = Carbon::now();
 
         $slider->save();
 
         Session::flash('success','slider Updated Successfully');
         return redirect()->route('slider.index');
 
     } // End Update Mathod

    public function delete($id)
    {
        $slider = Slider::find($id);
        $slider_image = $slider->slider_image;

        unlink($slider_image);
        $slider->delete();
        Session::flash('warning', 'Slider Delete Successfully');
        return redirect()->back();


    } // End destroy Mathod


    public function active($id){

        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->save();

        Session::flash('success','SLider Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->save();

        Session::flash('success','Slider Disabled Successfully.');
        return redirect()->back();
    }



} 