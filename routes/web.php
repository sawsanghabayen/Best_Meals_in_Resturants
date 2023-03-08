<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResturantController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderMealController;
use App\Http\Controllers\OrderReviewController;
use App\Http\Controllers\ReviewMealsController;
use App\Models\City;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::prefix('cms/')->middleware('guest:admin,user,resturant')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLoginView'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('forgot-password', [ResetPasswordController::class, 'showForgotPassword'])->name('password.forgot');
    Route::post('forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordView'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
});

Route::prefix('cms/admin')->middleware(['auth:admin,user,resturant'])->group(function () {
    Route::get('edit-password', [AuthController::class, 'editPassword'])->name('password.edit');
    Route::put('update-password', [AuthController::class, 'updatePassword']);
    
});   


Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
});

Route::prefix('cms/admin')->middleware(['auth:admin,resturant', 'verified'])->group(function () {
    Route::view('/', 'cms.parent');
    Route::resource('dashboards',  DashboardController::class);
    Route::resource('resturants', ResturantController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('meals', MealController::class);
    Route::resource('cities', CityController::class);
    Route::get('orders', [OrderController::class, 'index'])->name('rest.orders');
    // Route::resource('order', OrderController::class);

    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
});

Route::prefix('cms/admin')->middleware(['auth:admin,resturant', 'verified'])->group(function () {
    Route::get('admins/{admin}/permissions/edit', [AdminController::class, 'editAdminPermissions'])->name('admin.edit-permissions');
    Route::put('admins/{admin}/permissions/edit', [AdminController::class, 'updateAdminPermissions']);
    Route::get('resturants/{resturant}/permissions/edit', [ResturantController::class, 'editRestPermissions'])->name('resturant.edit-permissions');
    Route::put('resturants/{resturant}/permissions/edit', [ResturantController::class, 'updateRestPermissions']);
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('notifications/{notification}', [NotificationController::class, 'destroy']);
    Route::get('ordermeals', [OrderMealController::class,'index'])->name('admin.ordermeals');
});



  route::prefix('/')->group(function () {
   route::get('/' , [FrontController::class,'showproduct'])->name('front.index');

    Route::post('users', [UserController::class,'store']);
    Route::post('resturant', [ResturantController::class,'store']);
    // route::view('index' , 'front.index')->name('front.index');
    route::get('about' , [ResturantController::class,'index'])->name('front.about');
    route::get('meals' ,  [MealController::class,'index'])->name('front.meals');
    route::get('categories' , [CategoryController::class,'index'])->name('front.categories');
    route::get('categories/{category}' , [CategoryController::class,'show'])->name('front.categoriesshow');
    // route::view('contact' , 'front.contact')->name('front.contact');
    route::view('register' , 'cms.auth.register')->name('auth.register');
    Route::resource('contacts',ContactController::class)->except([ 'index' ,'destroy','show' ]);
    // Route::resource('details',ReviewMealsController::class);
    Route::get('meal-detail' ,[ReviewMealsController::class,'index'])->name('front.detail');
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
  
   
//    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');


    // route::view('cart' , 'front.cart');
});


Route::prefix('front')->middleware(['auth:user', 'verified'])->group(function () {
    Route::resource('favorites', FavoriteController::class);
    Route::resource('carts', CartController::class);
    // Route::resource('addresses', AddressController::class);
    Route::resource('orders', OrderController::class);
    // Route::resource('ordermeals', OrderMealController::class);
    Route::post('detail', [ReviewMealsController::class,'store']);
    Route::get('orders', [OrderController::class, 'index'])->name('user.orders');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
   
    // Route::resource('ordermeals', OrderMealController::class);
    Route::get('ordermeals', [OrderMealController::class,'index'])->name('user.ordermeals');
    Route::resource('addresses',AddressController::class);

});   

Route::get('register', function () {
    $cities = City::where('active', '=', true)->get();
    return response()->view('cms.auth.registerresturant', ['cities' => $cities]);
})->name('auth.registerresturant');


Route::prefix('cms/admin')->middleware('auth:admin,user,resturant')->group(function () {

    Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('send-verification', [EmailVerificationController::class, 'send'])->middleware('throttle:1,1')->name('verification.send');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
});
        
    
