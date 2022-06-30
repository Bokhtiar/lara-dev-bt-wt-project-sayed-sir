<?php
use Illuminate\Support\Facades\{Auth,Route,Artisan};
use App\Http\Controllers\Admin\
{
    BannerController,
    CategoryController,
    MedicineController,
    ProductController
};


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(["as"=>'user.', "prefix"=>'user',  "middleware"=>['auth','user']],function(){
    Route::get('dashboard', [App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('dashboard');
});

Route::group(["as"=>'admin.', "prefix"=>'admin', "middleware"=>['auth','admin']],function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    /*banner */
    Route::resource('banner', BannerController::class);
    Route::get('banner/status/{id}', [BannerController::class, 'status'])->name('banner.status');

    /*category */
    Route::resource('category', CategoryController::class);
    Route::get('category/status/{id}', [CategoryController::class, 'status'])->name('category.status');

    /*medidine */
    Route::resource('medicine', MedicineController::class);
    Route::get('medicine/status/{id}', [MedicineController::class, 'status'])->name('medicine.status');

    /*Product */
    Route::resource('product', ProductController::class);
    Route::get('product/status/{id}', [ProductController::class, 'status'])->name('product.status');
});



Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return "Cache is cleared";
});
