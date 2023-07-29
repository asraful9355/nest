@php
$id = Auth::user()->id;
$verdorId = App\Models\User::find($id);
$status = $verdorId->status; 
@endphp

<style>
   .bgt{
       background-image:url({{ asset('upload/1.png') }});
       /* background-color: #75B3E6;
       color:white */
   }
   .bgttext{
     
       color:white;
   }
</style>


<div class="sidebar-wrapper bgt" data-simplebar="true">
   <div class="sidebar-header bgt">
      <div>
         <img src="{{ asset('backend') }}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon bgttext">
      </div>
      <div>
         <h4 class="logo-text bgttext">Rukada</h4>
      </div>
      <div class="toggle-icon ms-auto"><i class='bgttext bx bx-arrow-to-left'></i>
      </div>
   </div>
   <!--navigation-->
   <ul class="metismenu" id="menu">
      <li>
         <a href="/admin/dashboard">
            <div class="parent-icon bgttext"><i class='bgttext bx bx-cookie'></i>
            </div>
            <div class="menu-title bgttext">Dashboard</div>
         </a>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title bgttext">Banner Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('banner.index') }}"><i class="bx bx-right-arrow-alt "></i>All Banner</a>
            </li>
            <li> <a href="{{ route('banner.create') }}"><i class="bx bx-right-arrow-alt "></i>Add Banner</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class='fa-solid fa-photo-film fontawesome_icon_custom'></i>
            </div>
            <div class="menu-title bgttext">Slider Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('slider.index') }}"><i class="bx bx-right-arrow-alt "></i>All Slider</a>
            </li>
            <li> <a href="{{ route('slider.create') }}"><i class="bx bx-right-arrow-alt "></i>Add Slider</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class='bgttext bx bx-home-circle'></i>
            </div>
            <div class="menu-title bgttext">Brand</div>
         </a>
         <ul>
            <li> <a href="{{ route('brand.index') }}"><i class="bx bx-right-arrow-alt "></i>All Brand</a>
            </li>
            <li> <a href="{{ route('brand.create') }}"><i class="bx bx-right-arrow-alt "></i>Add Brand</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class='bgttext bx bx-home-circle'></i>
            </div>
            <div class="menu-title bgttext">Category</div>
         </a>
         <ul>
            <li> <a href="{{ route('category.index') }}"><i class="bx bx-right-arrow-alt "></i>All Category</a>
            </li>
            <li> <a href="{{ route('category.create') }}"><i class="bx bx-right-arrow-alt "></i>Add Category</a>
            </li>
            <li> <a href="{{ route('subcategory.index') }}"><i class="bx bx-right-arrow-alt "></i>All Sub Category</a>
            </li>
            <li> <a href="{{ route('subcategory.create') }}"><i class="bx bx-right-arrow-alt "></i>Add Sub Category</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class='fa-solid fa-bag-shopping fontawesome_icon_custom'></i>
            </div>
            <div class="menu-title bgttext">Product Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('product.index') }}"><i class="bx bx-right-arrow-alt "></i>All Product</a>
            </li>
            <li> <a href="{{ route('product.create') }}"><i class="bx bx-right-arrow-alt "></i>Add Product</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title bgttext">Coupon System</div>
         </a>
         <ul>
            <li> <a href="{{ route('coupon.index') }}"><i class="bx bx-right-arrow-alt "></i>All Coupon</a>
            </li>
            <li> <a href="{{ route('coupon.create') }}"><i class="bx bx-right-arrow-alt "></i>Add Coupon</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title bgttext">Shipping Area</div>
         </a>
         <ul>
            <li> <a href="{{ route('division.index') }}"><i class="bx bx-right-arrow-alt "></i>All Division</a>
            </li>
            <li> <a href="{{ route('district.index') }}"><i class="bx bx-right-arrow-alt "></i>All District</a>
            </li>
            <li> <a href="{{ route('state.index') }}"><i class="bx bx-right-arrow-alt "></i>All State</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class='bgttext bx bx-cart'></i>
            </div>
            <div class="menu-title bgttext">Vendor Manage</div>
         </a>
         <ul>
            <li> <a href="ecommerce-products.html"><i class="bx bx-right-arrow-alt "></i>Products</a>
            </li>
            <li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt "></i>Inactive Vendor</a>
            </li>
            <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt "></i>Active Vendor</a>
            </li>
            <li> <a href="ecommerce-orders.html"><i class="bx bx-right-arrow-alt "></i>Orders</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="javascript:;" class="has-arrow" style="color:white">
            <div class="parent-icon bgttext"><i class='bgttext bx bx-cart'></i>
            </div>
            <div class="menu-title bgttext">Order Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt "></i> Pending Order</a>
            </li>
            <li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed Order</a>
            </li>
            <li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
            </li>
            <li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Order</a>
            </li>                                                                            
         </ul>
      </li>
   
    
     
   </ul>
   <!--end navigation-->
</div>