<?php
use App\Http\Controllers\Admin\Auth\LoginController as AdminLogin ;
use Illuminate\Support\Facades\Route;

    // ============================== ADMIN LOGIN ==============================
$prefix         = config('zvn.url.prefix_admin');
$controllerName = 'login';
Route::group(['prefix' =>  $prefix], function ()  { 
    Route::match(['get', 'post'], '/login', [AdminLogin::class, 'login'])->name('login');
    Route::get('/logout', [AdminLogin::class, 'logout'])->name('admin/logout');
});

// ============================== Laravel-Filemanager ============================== permission.admin
Route::group(['prefix' => 'laravel-filemanager' , 'middleware' => 'auth:admin'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


