<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Carbon;
use Image;
use Session;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
    } // End Index Mathod
    public function index()
    {
        $banners = Banner::all();
       return view('backend.banner.index',compact('banners'));
    } // End Index Mathod

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('banner_image')){
            $image = $request->file('banner_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
            $banner_image = 'upload/banner/'.$name_gen;
        }else{
            $banner_image = $request->banner_image;
        }

        $banner = new Banner;
        $banner->banner_title_en = $request->banner_title_en;
        if($request->banner_title_bn == ''){
            $banner->banner_title_bn = $request->banner_title_en;
        }else{
            $banner->banner_title_bn = $request->banner_title_bn;
        }

        if($request->status == Null){
            $request->status = 1;
        }
        $banner->banner_url = $request->banner_url;
        $banner->status = $request->status;
        $banner->banner_image = $banner_image;
        $banner->created_at = Carbon::now();
        $banner->save();
        Session::flash('success','banner Inserted Successfully');
        return redirect()->route('banner.index');

    } // End Store Mathod

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
      
        $banner = Banner::find($id);
    return view('backend.banner.edit', compact('banner'));
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
       $banner = Banner::find($id);

        if($request->hasfile('banner_image')){
            try {
                if(file_exists($banner->banner_image)){
                    unlink($banner->banner_image);
                }
            } catch (Exception $e) {

            }
            $image = $request->file('banner_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
            $banner_image = 'upload/banner/'.$name_gen;
        }else{
            $banner_image = $banner->banner_image;
        }

        $banner->banner_title_en = $request->banner_title_en;
        if($request->banner_title_bn == ''){
            $banner->banner_title_bn = $request->banner_title_en;
        }else{
            $banner->banner_title_bn = $request->banner_title_bn;
        }

        if($request->status == Null){
            $request->status = 1;
        }
    
        $banner->status = $request->status;
        $banner->banner_url = $request->banner_url;
        $banner->banner_image = $banner_image;
        $banner->created_at = Carbon::now();
        $banner->save();
        Session::flash('success','Banner Updated Successfully');
        return redirect()->route('banner.index');

    } // End Update Mathod

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $banner = Banner::find($id);
        $banner_image = $banner->banner_image;
        unlink($banner_image);
        $banner->delete();
        Session::flash('warning', 'Banner Delete Successfully');
        return redirect()->back();
    } // End destroy Mathod


    public function active($id){

        $banner = Banner::find($id);
        $banner->status = 1;
        $banner->save();
        Session::flash('success','Banner Active Successfully.');
        return redirect()->back();
    }

    public function inactive($id){
        $banner = Banner::find($id);
        $banner->status = 0;
        $banner->save();
        Session::flash('success','Banner Disabled Successfully.');
        return redirect()->back();
    }
}
