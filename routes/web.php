<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\CouponController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\IndexController ;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\Backend\SiteSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

 Route::get('/', [IndexController::class, 'Index']);

/*================== Multi Language All Routes =================*/
Route::get('/language/bangla', [LanguageController::class, 'Bangla'])->name('bangla.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
}); // Group Middleware End



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// ======= All Admin Route=========
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    // ==================== Admin Product All Routes ===================//
Route::prefix('product')->group(function(){
    Route::get('/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/view/{id}', [ProductController::class, 'view'])->name('product.view');
    Route::get('/view/{id}', [ProductController::class, 'view'])->name('product.view');
    Route::post('/update/{id}',[ProductController::class, 'update'])->name('product.update');
    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/product_active/{id}', [ProductController::class, 'active'])->name('product.active');
    Route::get('/product_inactive/{id}', [ProductController::class, 'inactive'])->name('product.in_active');
    Route::post('/product/update/thambnail/{id}', [ProductController::class, 'ProductUpdateThambnail'])->name('product.update.thambnail');
    Route::post('/product/update/multiimage', [ProductController::class, 'ProductUpdateMultiimage'])->name('product.update.multiimage');
    Route::get('/product/multiimg/delete/{id}' , [ProductController::class,'MulitImageDelelte'])->name('product.multiimg.delete');
    /* ================  Category & Subcategory With Ajax ================== */
    Route::get('/category-subcategory/ajax/{category_id}',[ProductController::class,'getsubcategory'])->name('subcategory.product.ajax');
	
    Route::get('/product/stock' ,[ProductController::class,'ProductStock'])->name('product.stock');

});
 // ==================== Admin Brand All Routes ===================//
Route::prefix('brand')->group(function(){
    Route::get('/index', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::get('/view/{id}', [BrandController::class, 'view'])->name('brand.view');
    Route::get('/view/{id}', [BrandController::class, 'view'])->name('brand.view');
    Route::post('/update/{id}',[BrandController::class, 'update'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
    Route::get('/brand_active/{id}', [BrandController::class, 'active'])->name('brand.active');
    Route::get('/brand_inactive/{id}', [BrandController::class, 'inactive'])->name('brand.in_active');
});

   // ==================== Site Setting All Routes ===================//
Route::controller(SiteSettingController::class)->group(function(){

    Route::get('/site/setting' , 'SiteSetting')->name('site.setting');
    Route::post('/site/setting/update' , 'SiteSettingUpdate')->name('site.setting.update');
    Route::get('/seo/setting' , 'SeoSetting')->name('seo.setting');
    Route::post('/seo/setting/update' , 'SeoSettingUpdate')->name('seo.setting.update');
   
});
    // ==================== Admin Slider All Routes ===================//
Route::prefix('slider')->group(function(){
    Route::get('/index', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::get('/view/{id}', [SliderController::class, 'view'])->name('slider.view');
    Route::get('/view/{id}', [SliderController::class, 'view'])->name('slider.view');
    Route::post('/update/{id}',[SliderController::class, 'update'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
    Route::get('/slider_active/{id}', [SliderController::class, 'active'])->name('slider.active');
    Route::get('/slider_inactive/{id}', [SliderController::class, 'inactive'])->name('slider.in_active');
});
    // ==================== Banner Slider All Routes ===================//
Route::prefix('banner')->group(function(){
    Route::get('/index', [BannerController::class, 'index'])->name('banner.index');
    Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
    Route::post('/store', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
    Route::get('/view/{id}', [BannerController::class, 'view'])->name('banner.view');
    Route::get('/view/{id}', [BannerController::class, 'view'])->name('banner.view');
    Route::post('/update/{id}',[BannerController::class, 'update'])->name('banner.update');
    Route::get('/delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');
    Route::get('/banner_active/{id}', [BannerController::class, 'active'])->name('banner.active');
    Route::get('/banner_inactive/{id}', [BannerController::class, 'inactive'])->name('banner.in_active');
});

// Active user and vendor All Route 
Route::controller(BlogController::class)->group(function(){
    Route::get('/admin/blog/category' , 'AllBlogCateogry')->name('admin.blog.category'); 
    Route::get('/admin/add/blog/category' , 'AddBlogCateogry')->name('add.blog.categroy');
    Route::post('/admin/store/blog/category' , 'StoreBlogCateogry')->name('store.blog.category');
    Route::get('/admin/edit/blog/category/{id}' , 'EditBlogCateogry')->name('edit.blog.category');
    Route::post('/admin/update/blog/category/{id}' , 'UpdateBlogCateogry')->name('update.blog.category');
    Route::get('/admin/delete/blog/category/{id}' , 'DeleteBlogCateogry')->name('delete.blog.category');
});

// Admin Reviw All Route 
Route::controller(ReviewController::class)->group(function(){
    Route::get('/pending/review' , 'PendingReview')->name('pending.review');
    Route::get('/review/approve/{id}' , 'ReviewApprove')->name('review.approve');
    Route::get('/review/approve/{id}' , 'ReviewApprove')->name('review.approve');
    Route::get('/publish/review' , 'PublishReview')->name('publish.review'); 
    Route::get('/review/delete/{id}' , 'ReviewDelete')->name('review.delete');
});

// Blog Post All Route 
Route::controller(BlogController::class)->group(function(){

    Route::get('/admin/blog/post' , 'AllBlogPost')->name('admin.blog.post'); 
   
     Route::get('/admin/add/blog/post' , 'AddBlogPost')->name('add.blog.post');
     Route::post('/admin/store/blog/post' , 'StoreBlogPost')->name('store.blog.post');
     Route::get('/admin/edit/blog/post/{id}' , 'EditBlogPost')->name('edit.blog.post');
   
     Route::post('/admin/update/blog/post/{id}' , 'UpdateBlogPost')->name('update.blog.post');
     Route::get('/admin/delete/blog/post/{id}' , 'DeleteBlogPost')->name('delete.blog.post');
   
   
   });
   
  // ==================== Admin Category All Routes ===================//
  Route::prefix('category')->group(function(){
    Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/view/{id}', [CategoryController::class, 'view'])->name('category.view');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update/{id}',[CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/category_active/{id}', [CategoryController::class, 'active'])->name('category.active');
    Route::get('/category_inactive/{id}', [CategoryController::class, 'inactive'])->name('category.in_active');
 });

 // ==================== Admin SubCategory All Routes ===================//
Route::prefix('subcategory')->group(function(){
    Route::get('/index', [SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::get('/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/view/{id}', [SubCategoryController::class, 'view'])->name('subcategory.view');
    Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/update/{id}',[SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::get('/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');
    Route::get('/subcategory_active/{id}', [SubCategoryController::class, 'active'])->name('subcategory.active');
    Route::get('/subcategory_inactive/{id}', [SubCategoryController::class, 'inactive'])->name('subcategory.in_active');
    Route::get('/category-subcategory/ajax/{category_id}',[SubCategoryController::class,'getsubcategory'])->name('subcategory.ajax');
});
// ==================== Admin SubSubCategory All Routes ===================//
Route::prefix('subsubcategory')->group(function(){
    Route::get('/index', [SubSubCategoryController::class, 'index'])->name('subsubcategory.index');
    Route::get('/create', [SubSubCategoryController::class, 'create'])->name('subsubcategory.create');
    Route::post('/store', [SubSubCategoryController::class, 'store'])->name('subsubcategory.store');
    Route::get('/view/{id}', [SubSubCategoryController::class, 'view'])->name('subsubcategory.view');
    Route::get('/edit/{id}', [SubSubCategoryController::class, 'edit'])->name('subsubcategory.edit');
    Route::post('/update/{id}',[SubSubCategoryController::class, 'update'])->name('subsubcategory.udate');
    Route::get('/delete/{id}', [SubSubCategoryController::class, 'delete'])->name('subsubcategory.delete');
    Route::get('/subsubcategory_active/{id}', [SubSubCategoryController::class, 'active'])->name('subsubcategory.active');
    Route::get('/subsubcategory_inactive/{id}', [SubSubCategoryController::class, 'inactive'])->name('subsubcategory.in_active');
    
});

// Report All Route 
Route::controller(ReportController::class)->group(function(){
    Route::get('/report/view' , 'ReportView')->name('report.view');
    Route::post('/search/by/date' , 'SearchByDate')->name('search-by-date');
    Route::post('/search/by/month' , 'SearchByMonth')->name('search-by-month');
    Route::post('/search/by/year' , 'SearchByYear')->name('search-by-year');
    Route::get('/order/by/user' , 'OrderByUser')->name('order.by.user');
    Route::post('/search/by/user' , 'SearchByUser')->name('search-by-user');
 }); 

// Active user and vendor All Route 
Route::controller(ActiveUserController::class)->group(function(){

    Route::get('/all/user' , 'AllUser')->name('all-user');
    Route::get('/all/vendor' , 'AllVendor')->name('all-vendor');
});
 

 // ==================== Admin Brand All Routes ===================//
 Route::prefix('coupon')->group(function(){
    Route::get('/index', [CouponController::class, 'index'])->name('coupon.index');
    Route::get('/create', [CouponController::class, 'create'])->name('coupon.create');
    Route::post('/store', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
    Route::get('/view/{id}', [CouponController::class, 'view'])->name('coupon.view');
    Route::get('/view/{id}', [CouponController::class, 'view'])->name('coupon.view');
    Route::post('/update/{id}',[CouponController::class, 'update'])->name('coupon.update');
    Route::get('/delete/{id}', [CouponController::class, 'delete'])->name('coupon.delete');
    Route::get('/coupon_active/{id}', [CouponController::class, 'active'])->name('coupon.active');
    Route::get('/coupon_inactive/{id}', [CouponController::class, 'inactive'])->name('coupon.in_active');
});

 // Shipping Division All Route 
 Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/division' , 'AllDivision')->name('division.index');
    Route::get('/add/division' , 'AddDivision')->name('division.create');
    Route::post('/store/division' , 'StoreDivision')->name('division.store');
    Route::get('/edit/coupon/{id}' , 'EditDivision')->name('division.edit');
    Route::post('/update/coupon' , 'UpdateDivision')->name('division.update');
    Route::get('/delete/coupon/{id}' , 'DeleteDivision')->name('division.delete');

});


 // Shipping District All Route 
 Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/district' , 'AllDistrict')->name('district.index');
    Route::get('/add/district' , 'AddDistrict')->name('district.create');
    Route::post('/store/district' , 'StoreDistrict')->name('district.store');
    Route::get('/edit/division/{id}' , 'EditDistrict')->name('district.edit');
    Route::post('/update/division' , 'UpdateDistrict')->name('district.update');
    Route::get('/delete/division/{id}' , 'DeleteDistrict')->name('district.delete');

}); 

 // Admin Order All Route 
 Route::controller(OrderController::class)->group(function(){
    Route::get('/pending/order' , 'PendingOrder')->name('pending.order');
    Route::get('/admin/order/details/{order_id}' , 'AdminOrderDetails')->name('admin.order.details');
    Route::get('/admin/confirmed/order' , 'AdminConfirmedOrder')->name('admin.confirmed.order');
    Route::get('/admin/processing/order' , 'AdminProcessingOrder')->name('admin.processing.order');
    Route::get('/admin/delivered/order' , 'AdminDeliveredOrder')->name('admin.delivered.order');
    Route::get('/pending/confirm/{order_id}' , 'PendingToConfirm')->name('pending-confirm');
    Route::get('/confirm/processing/{order_id}' , 'ConfirmToProcess')->name('confirm-processing');
    Route::get('/processing/delivered/{order_id}' , 'ProcessToDelivered')->name('processing-delivered');
    Route::get('/admin/invoice/download/{order_id}' , 'AdminInvoiceDownload')->name('admin.invoice.download');

}); 


 // Return Order All Route 
 Route::controller(ReturnController::class)->group(function(){
    Route::get('/return/request' , 'ReturnRequest')->name('return.request');
    Route::get('/return/request/approved/{order_id}' , 'ReturnRequestApproved')->name('return.request.approved');
    Route::get('/complete/return/request' , 'CompleteReturnRequest')->name('complete.return.request');

});




 // Shipping State All Route 
 Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/state' , 'AllState')->name('state.index');
    Route::get('/add/state' , 'AddState')->name('state.create');
    Route::post('/store/state' , 'StoreState')->name('state.store');
    Route::get('/edit/state/{id}' , 'EditState')->name('state.edit');
    Route::post('/update/state' , 'UpdateState')->name('state.update');
    Route::get('/delete/state/{id}' , 'DeleteState')->name('state.delete');

    Route::get('/district/ajax/{division_id}' , 'GetDistrict');

}); 

 // Vendor Active and Inactive All Route 
  Route::controller(AdminController::class)->group(function(){
    Route::get('/inactive/vendor' , 'InactiveVendor')->name('inactive.vendor');
    Route::get('/active/vendor' , 'ActiveVendor')->name('active.vendor');
    Route::get('/active/vendor/details/{id}' , 'activeVendorDetails')->name('active.vendor.details');
    Route::post('/active/vendor/approve' , 'ActiveVendorApprove')->name('active.vendor.approve');
    Route::get('/inactive/vendor/details/{id}' , 'InactiveVendorDetails')->name('inactive.vendor.details');
    Route::post('/inactive/vendor/approve' , 'InActiveVendorApprove')->name('inactive.vendor.approve');
  
});
 
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');

// ======= All Vendor Route=========
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard')->name('vendor.dashboard');

    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');

    // Vendor Add Product All Route 
    Route::controller(VendorProductController::class)->group(function(){
    Route::get('/vendor/all/product' , 'index')->name('vendor.product.index');
    Route::get('/vendor/create/product' , 'create')->name('vendor.product.create');
    Route::get('/vendor/subcategory/ajax/{category_id}','VendorGetsubcategory')->name('vendor.subcategory.product.ajax');
    Route::post('/vendor/product/store', [VendorProductController::class, 'VendorProductStore'])->name('vendor.product.store');
    Route::get('/vendor/product/edit/{id}', [VendorProductController::class, 'vendorProductEdit'])->name('vendor.product.edit');
    Route::post('/vendor/product/update/{id}',[VendorProductController::class, 'VendorProductUpdate'])->name('vendor.product.update');


    Route::post('/vendor/product/update/thambnail/{id}', [VendorProductController::class, 'VendorProductUpdateThambnail'])->name('vendor.product.update.thambnail');

    Route::post('/vendor/product/multiimg/update', [VendorProductController::class, 'VendorProductUpdateMultiimage'])->name('multiimage_update');
    
    Route::get('/vendor/product/multiimg/delete/{id}' , [VendorProductController::class,'VendorMulitImageDelelte'])->name('vendor.product.multiimg.delete');

    Route::get('/vendor/product/delete/{id}', [VendorProductController::class, 'VendorProductDelete'])->name('vendor.product.delete');
    Route::get('/vendor/product_active/{id}', [VendorProductController::class, 'VendorProductActive'])->name('vendor.product.active');
    Route::get('/vendor/product_inactive/{id}', [VendorProductController::class, 'VendorProductInactive'])->name('vendor.product.in_active');
    });

   // vendor review route 
   Route::controller(ReviewController::class)->group(function(){

        Route::get('/vendor/all/review' , 'VendorAllReview')->name('vendor.all.review');
       
   });
       
    Route::controller(VendorOrderController::class)->group(function(){
        Route::get('/vendor/order' , 'VendorOrder')->name('vendor.order');
        Route::get('/vendor/return/order' , 'VendorReturnOrder')->name('vendor.return.order');
        Route::get('/vendor/complete/return/order' , 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');
        Route::get('/vendor/order/details/{order_id}' , 'VendorOrderDetails')->name('vendor.order.details');
    });

});//end Vendor group middleware  

/// Frontend Product Details All Route 
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Product View Modal With Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);
// Add to cart  store data 

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

// mini cart remove er jonne 
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

/// Add to cart store data For Product Details Page 
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);
/// Add to Wishlist 
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);
   
// Add to Compare 
   Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

// User All Route
Route::middleware(['auth','role:user'])->group(function() {

    // Wishlist All Route 
   Route::controller(WishlistController::class)->group(function(){
       Route::get('/wishlist' , 'AllWishlist')->name('wishlist');
       Route::get('/get-wishlist-product' , 'GetWishlistProduct');
       Route::get('/wishlist-remove/{id}' , 'WishlistRemove'); 

}); 



 // Cart All Route 
 Route::controller(CartController::class)->group(function(){
    Route::get('/mycart' , 'MyCart')->name('mycart');
    Route::get('/get-cart-product' , 'GetCartProduct');
    Route::get('/cart-remove/{rowId}' , 'CartRemove');
    Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
    Route::get('/cart-increment/{rowId}' , 'CartIncrement');

}); 



 // Compare All Route 
Route::controller(CompareController::class)->group(function(){
    Route::get('/compare' , 'AllCompare')->name('compare');
    Route::get('/get-compare-product' , 'GetCompareProduct');
    Route::get('/compare-remove/{id}' , 'CompareRemove'); 
}); 
   
   }); // end group middleware


/// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Checkout Page Route 
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');


// Cart All Route 
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart' , 'MyCart')->name('mycart');
    Route::get('/get-cart-product' , 'GetCartProduct');
    Route::get('/cart-remove/{rowId}' , 'CartRemove');

    Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
    Route::get('/cart-increment/{rowId}' , 'CartIncrement');
}); 

// checkout All Route 
Route::controller(CheckoutController::class)->group(function(){
    Route::get('/district-get/ajax/{division_id}' , 'DistrictGetAjax');
    Route::get('/state-get/ajax/{district_id}' , 'StateGetAjax');
    Route::post('/checkout/store' , 'CheckoutStore')->name('checkout.store');


}); 
 // Stripe All Route 
 Route::controller(StripeController::class)->group(function(){
    Route::post('/stripe/order' , 'StripeOrder')->name('stripe.order');
    Route::post('/cash/order' , 'CashOrder')->name('cash.order');


}); 

Route::controller(AllUserController::class)->group(function(){
    Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');
    Route::get('/user/change/password' , 'UserChangePassword')->name('user.change.password');
    Route::get('/user/order/page' , 'UserOrderPage')->name('user.order.page');
    Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');
    Route::get('/user/invoice_download/{order_id}' , 'UserOrderInvoice');  
    Route::post('/return/order/{order_id}' , 'ReturnOrder')->name('return.order');
    Route::get('/return/order/page' , 'ReturnOrderPage')->name('return.order.page');

    // Order Tracking 
    Route::get('/user/track/order' , 'UserTrackOrder')->name('user.track.order');
    Route::post('/order/tracking' , 'OrderTracking')->name('order.tracking');
}); 

// Frontend Blog Post All Route 
Route::controller(BlogController::class)->group(function(){
   Route::get('/blog' , 'AllBlog')->name('home.blog');  
   Route::get('/post/details/{id}/{slug}' , 'BlogDetails');  
   Route::get('/post/details/{id}/{slug}' , 'BlogDetails'); 
   Route::get('/post/category/{id}/{slug}' , 'BlogPostCategory');  
});

// Search All Route 
Route::controller(IndexController::class)->group(function(){

    Route::post('/search' , 'ProductSearch')->name('product.search');
    Route::post('/search-product' , 'SearchProduct'); 
    
});

// Frontend Blog Post All Route 
Route::controller(ReviewController::class)->group(function(){
   Route::post('/store/review' , 'StoreReview')->name('store.review'); 
});
   