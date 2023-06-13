<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Image;
use Carbon\Carbon;
use Auth;

class VendorProductController extends Controller
{
    public function index(){

        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('backend.product.vendor_index',compact('products'));
    } // End Method 

    public function create(){
       $brands = Brand::latest()->get();
       $categories = Category::latest()->get();
       return view('backend.product.vendor_create',compact('brands','categories'));
    }

    public function VendorGetsubcategory($category_id){

        $subcat = Subcategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    
public function VendorProductStore(Request $request)
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
        'vendor_id' => Auth::user()->id,
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
        'message' => 'Vendor Product Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('vendor.product.index')->with($notification); 

}//End Method
}
