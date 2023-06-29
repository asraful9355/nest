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
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\IndexController ;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CompareController;


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
});//end group middleware  

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


 // Compare All Route 
Route::controller(CompareController::class)->group(function(){
    Route::get('/compare' , 'AllCompare')->name('compare');
    Route::get('/get-compare-product' , 'GetCompareProduct');
    Route::get('/compare-remove/{id}' , 'CompareRemove'); 
}); 
   
   }); // end group middleware



