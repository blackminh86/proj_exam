<?php
use Illuminate\Support\Facades\Route;
    
// ============================== Home ==============================
$prefix         = '';
$controllerName = 'home';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',        ['as' => 'home',          'uses' => $controller . 'index']);
  

});
// ============================== Contact ==============================

$prefix         = 'message';
$controllerName = 'message';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',     ['as' => $controllerName . '.show',          'uses' => $controller . 'show']);
    Route::get('/send',     ['as' => $controllerName . '.send',          'uses' => $controller . 'send']);

});
// ============================== Order ==============================

$prefix         = 'order';
$controllerName = 'order';
Route::group(['prefix' =>  $prefix], function () use ($controllerName ) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/checkout',     ['as' => $controllerName . '.checkout',          'uses' => $controller . 'checkout']);
    Route::get('/store',        ['as' => $controllerName . '.store',          'uses' => $controller . 'store']);
});

// ============================== PRODUCT ==============================
$prefix         = 'product';
$controllerName = 'product';
Route::group(['prefix' =>  $prefix], function () use ($controllerName ) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/{slug?}-{id}.html',     ['as' => $controllerName . '.show',          'uses' => $controller . 'show'])
        ->where('slug', '[0-9A-z-+_]+')
        ->where('id', '[0-9]+');
    Route::get('/ajax-variation-product',  ['as' => $controllerName . '.ajax-variation-product', 'uses' => $controller . 'ajaxVariation']);
    //Route::get('/ajax-cart',  ['as' => $controllerName . '.ajax-cart', 'uses' => $controller . 'ajaxCart']); 
});
// ============================== CART ==============================
$prefix         = 'cart';
$controllerName = 'cart';
Route::group(['prefix' =>  $prefix], function () use ($controllerName ) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',       ['as' => $controllerName . '.show',          'uses' => $controller . 'show']);
    Route::get('/store',  ['as' => $controllerName . '.store', 'uses' => $controller . 'store']);
    Route::get('/fo',  ['as' => $controllerName . '.form-info', 'uses' => $controller . 'formInfo']);
    Route::get('/update-cart',  ['as' => $controllerName . '.update-cart', 'uses' => $controller . 'updateCart']);
});

// ============================== PRODUCT CATEGORY ==============================
$prefix         = 'category';
$controllerName = 'productCategory';
Route::group(['prefix' =>  $prefix], function () use ($controllerName ) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/{slug?}-{id}',     ['as' => $controllerName . '.show',          'uses' => $controller . 'show'])
        ->where('slug', '[0-9A-z-+_]+')
        ->where('id', '[0-9]+');
    Route::get('/ajax',     ['as' => $controllerName . '.ajax',          'uses' => $controller . 'ajax']);

});
// ============================== SEARCH ==============================
$prefix         = 'search';
$controllerName = 'keyword';
Route::group(['prefix' =>  $prefix], function () use ($controllerName ) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',     ['as' => $controllerName . '.search_product',          'uses' => $controller . 'show'])->where('slug', '[0-9A-z-+_]+');

});
    
   
                                       
                                        



// ====================== RESIZE IMAGE ========================
// usage inside a laravel route
/*
Route::get('/resize/85x85/{image}', function ($image) {
    dd(ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled');
    $image = asset('images/product/' . $image);
    $img = Image::make($image)->resize(85, 85);
    dd($img->response('jpg'));
    return $img->response('jpg');
})
*/
