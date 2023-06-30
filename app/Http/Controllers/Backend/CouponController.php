<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use Session;
use Auth;

class CouponController extends Controller
{
    public function index(){
        $coupon = Coupon::latest()->get();
        return view('backend.coupon.index',compact('coupon'));
    } // End Method 

    public function create(){
        return view('backend.coupon.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required'
        ]);

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->first();

        if($coupon){
            Session::flash('warning','Coupon already Created.');
            return redirect()->back(); 
        }else{
            $coupon = Coupon::insert([
                'coupon_name' => strtoupper($request->coupon_name),
                'coupon_discount'=>$request->coupon_discount,
                'coupon_validity' => $request->coupon_validity,
                'created_at' => Carbon::now()
            ]);
        }

        Session::flash('success','Coupon Inserted Successfully.');
        return redirect()->route('coupon.index');
    }
    public function edit($id){

        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.edit',compact('coupon'));

    }// End Method 


    public function update(Request $request){

        $coupon_id = $request->id;

         Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('coupon.index')->with($notification); 


    }// End Method 

     public function delete($id){

        Coupon::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 

}
