<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;


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

Route::get('/', function () {
    return view('frontend.index');
});


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
});
