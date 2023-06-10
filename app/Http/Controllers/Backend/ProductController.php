<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;
use Session;
class ProductController extends Controller
{
     //
     public function index(){
        $products = Product::latest()->get();
        return view('backend.product.index',compact('products'));
    } // End Method 

    public function create(){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('backend.product.create',compact('brands','categories','activeVendor'));
    } // End Method 

  
   /* ============ category with subcategory show ============= */
   public function getsubcategory($category_id){

    $subcat = Subcategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
    return json_encode($subcat);
}

public function store(Request $request)
{  
    $image = $request->file('product_thambnail');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
    $save_url = 'upload/products/thambnail/'.$name_gen;

    $product_id = Product::insertGetId([

        'brand_id' => $request->brand_id,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'product_name_en' => $request->product_name_en,
        'product_name_bn' => $request->product_name_bn,
        'product_slug' => strtolower(str_replace(' ','-',$request->product_name_en)),
        'product_code' => $request->product_code,
        'product_qty' => $request->product_qty,
        'product_tags' => $request->product_tags,
        'product_size' => $request->product_size,
        'product_color' => $request->product_color,

        'selling_price' => $request->selling_price,
        'discount_price' => $request->discount_price,
        'short_descp_en' => $request->short_descp_en,
        'short_descp_bn' => $request->short_descp_bn,
        'long_descp_en' => $request->long_descp_en, 
        'long_descp_bn' => $request->long_descp_bn, 

        'hot_deals' => $request->hot_deals,
        'featured' => $request->featured,
        'special_offer' => $request->special_offer,
        'special_deals' => $request->special_deals, 

        'product_thambnail' => $save_url,
        'vendor_id' => $request->vendor_id,
        'status' => 1,
        'created_at' => Carbon::now(), 

    ]);

    /// Multiple Image Upload From her //////
    $images = $request->file('multi_img');
    foreach($images as $img){
        $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    Image::make($img)->resize(800,800)->save('upload/products/multi-image/'.$make_name);
    $uploadPath = 'upload/products/multi-image/'.$make_name;

    
    MultiImg::insert([

        'product_id' => $product_id,
        'photo_name' => $uploadPath,
        'created_at' => Carbon::now(), 

    ]); 
    } // end foreach

    /// End Multiple Image Upload From her //////

    $notification = array(
        'message' => 'Product Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('product.index')->with($notification); 

}//End Method

public function edit($id){
     $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
     $multiImgs = MultiImg::where('product_id',$id)->get();
     $brands = Brand::latest()->get();
     $categories = Category::latest()->get();
     $subcategory = SubCategory::latest()->get();
     $products = Product::findOrFail($id);
     return view('backend.product.edit',compact('multiImgs','brands','categories','activeVendor','products','subcategory'));
 }// End Method 

 public function update(Request $request){

    $product_id = $request->id;

    Product::findOrFail($product_id)->update([

   'brand_id' => $request->brand_id,
   'category_id' => $request->category_id,
   'subcategory_id' => $request->subcategory_id,
   'product_name_en' => $request->product_name_en,
   'product_name_bn' => $request->product_name_bn,
   'product_slug' => strtolower(str_replace(' ','-',$request->product_name_en)),

   'product_code' => $request->product_code,
   'product_qty' => $request->product_qty,
   'product_tags' => $request->product_tags,
   'product_size' => $request->product_size,
   'product_color' => $request->product_color,

   'selling_price' => $request->selling_price,
   'discount_price' => $request->discount_price,
   'short_descp_en' => $request->short_descp_en,
   'short_descp_bn' => $request->short_descp_bn,
   'long_descp_en' => $request->long_descp_en, 
   'long_descp_bn' => $request->long_descp_bn, 

   'hot_deals' => $request->hot_deals,
   'featured' => $request->featured,
   'special_offer' => $request->special_offer,
   'special_deals' => $request->special_deals, 


   'vendor_id' => $request->vendor_id,
   'status' => 1,
   'created_at' => Carbon::now(), 

]);


$notification = array(
   'message' => 'Product Updated Without Image Successfully',
   'alert-type' => 'success'
);

return redirect()->route('product.index')->with($notification); 

}// End Method 


public function ProductUpdateThambnail(Request $request, $id){

    $product = Product::find($id);

    if($request->hasfile('product_thambnail')){
        try {
            if(file_exists($product->product_thambnail)){
                unlink($product->product_thambnail);
            }
        } catch (Exception $e) {

        }
        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
        $product_thambnail = 'upload/products/thambnail/'.$name_gen;
    }else{
        $product_thambnail = $product->product_thambnail;
    }

  

    $product->product_thambnail = $product_thambnail;

    $product->created_at = Carbon::now();

    $product->save();

    Session::flash('success','Product Updated Successfully');
    return redirect()->back();

}// End Method

// Multi Image Update 
public function ProductUpdateMultiimage(Request $request){

    $imgs = $request->multi_img;

    foreach($imgs as $id => $img ){
        $imgDel = MultiImg::findOrFail($id);
        unlink($imgDel->photo_name);

$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    Image::make($img)->resize(800,800)->save('upload/products/multi-image/'.$make_name);
    $uploadPath = 'upload/products/multi-image/'.$make_name;

    MultiImg::where('id',$id)->update([
        'photo_name' => $uploadPath,
        'updated_at' => Carbon::now(),

    ]); 
    } // end foreach

     $notification = array(
        'message' => 'Product Multi Image Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification); 

}// End Method 



public function MulitImageDelelte($id){
    $oldImg = MultiImg::findOrFail($id);
    unlink($oldImg->photo_name);

    MultiImg::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Product Multi Image Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

}// End Method 

public function active($id){

    $product = Product::find($id);
    $product->status = 1;
    $product->save();

    Session::flash('success','Product Active Successfully.');
    return redirect()->back();
}

public function inactive($id){
    $product = Product::find($id);
    $product->status = 0;
    $product->save();

    Session::flash('success','Product Disabled Successfully.');
    return redirect()->back();

}


    
}
