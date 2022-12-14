<?php
// ============================== DASHBOARD ==============================
$prefix         = 'dashboard';
$controllerName = 'dashboard';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
});

// ============================== BANNER ==============================
$prefix         = 'banner';
$controllerName = 'banner';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';

    Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
});

// ============================== CATEGORY ==============================
$prefix         = 'category';
$controllerName = 'articleCategory';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    Route::get('change-is-home-{is_home}/{id}',     ['as' => $controllerName . '/isHome',      'uses' => $controller . 'isHome'])->where('id', '[0-9]+');
    Route::get('change-display-{display}/{id}',     ['as' => $controllerName . '/display',     'uses' => $controller . 'display']);
    Route::get('update-move',                       ['as' => $controllerName . '/updateMove',        'uses' => $controller . 'updateMove']);
});

// ============================== PRODUCT CATEGORY ==============================
$prefix         = 'product_category';
$controllerName = 'productCategory';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('auto-generated-form',               ['as' => $controllerName . '/autoGeneratedForm',        'uses' => $controller . 'autoGeneratedForm']);
    Route::get('auto-generated-save',               ['as' => $controllerName . '/autoGeneratedSave',        'uses' => $controller . 'autoGeneratedSave']);
    Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    Route::get('change-is-home-{is_home}/{id}',     ['as' => $controllerName . '/isHome',      'uses' => $controller . 'isHome'])->where('id', '[0-9]+');
    Route::get('change-display-{display}/{id}',     ['as' => $controllerName . '/display',     'uses' => $controller . 'display']);
    Route::get('update-move',                       ['as' => $controllerName . '/updateMove',        'uses' => $controller . 'updateMove']);
});
// ============================== PRODUCTS ==============================
$prefix         = 'product';
$controllerName = 'product';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::get('data-scraper-form',                 ['as' => $controllerName . '/data-scraper-form', 'uses' => $controller . 'dataScraperForm']);
    Route::post('data-scraper',                      ['as' => $controllerName . '/data-scraper', 'uses' => $controller . 'dataScraper']);
    Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('draft',                             ['as' => $controllerName . '/draft',       'uses' => $controller . 'draft']);
    Route::post('save-draft',                       ['as' => $controllerName . '/save-draft',  'uses' => $controller . 'saveDraft']);
    Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status']);
    Route::get('change-type-{type}/{id}',           ['as' => $controllerName . '/type',        'uses' => $controller . 'type']);
    Route::get('/ajax-attribute',                   ['as' => $controllerName . '/ajax-attribute', 'uses' => $controller . 'ajaxAttribute']);
    Route::get('/ajax-variation',                   ['as' => $controllerName . '/ajax-variation', 'uses' => $controller . 'ajaxVariation']);
    Route::get('/delete-variable-element',     ['as' => $controllerName . '/delete-variable-element', 'uses' => $controller . 'deleteVariableElement']);
});

// ============================== ATTRIBUTE ==============================
$prefix         = 'attribute';
$controllerName = 'attribute';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
});
// ============================== ATTRIBUTE PRODUCT ==============================
$prefix         = 'attribute-product';
$controllerName = 'attributeProduct';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
});


// ============================== MENU ==============================
$prefix         = 'menu';
$controllerName = 'menu';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    Route::get('change-type-menu/{type_menu}/{id}',           ['as' => $controllerName . '/type_menu',        'uses' => $controller . 'type']);
    Route::get('change-type-open/{type_open}/{id}',           ['as' => $controllerName . '/type_open',        'uses' => $controller . 'type']);
    Route::get('update-move',                       ['as' => $controllerName . '/updateMove',        'uses' => $controller . 'updateMove']);
});

// ============================== ARTICLE ==============================
$prefix         = 'article';
$controllerName = 'article';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status']);
    Route::get('change-type-{type}/{id}',           ['as' => $controllerName . '/type',        'uses' => $controller . 'type']);
});

// ============================== USER ==============================
$prefix         = 'user';
$controllerName = 'user';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::post('change-password',                  ['as' => $controllerName . '/change-password',        'uses' => $controller . 'changePassword']);
    Route::post('change-level',                     ['as' => $controllerName . '/change-level',        'uses' => $controller . 'changeLevel']);
    Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status']);
    Route::get('change-level-{level}/{id}',         ['as' => $controllerName . '/level',      'uses' => $controller . 'level']);
});

// ============================== RSS ==============================
$prefix         = 'rss';
$controllerName = 'rss';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
});

// ============================== FILE MANAGER ==============================
$prefix         = 'file-manager';
$controllerName = 'file';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
});
// ============================== SETTING  ==============================
$prefix         = 'setting';
$controllerName = 'setting';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
});
// ============================== CHANGE PASSWORD =============================
$prefix         = 'change-password';
$controllerName = 'changepass';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
});
// ============================== UPLOAD FILE =============================
$prefix         = 'file';
$controllerName = 'file';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('create/',                       $controller . 'create');
    Route::post('create/',                      $controller . 'store');
    Route::get('edit/{id}',                     $controller . 'edit')->name('file.edit');
    Route::post('edit/',                        $controller . 'update');
});
// ============================== MESSAGES ==============================
$prefix         = 'message';
$controllerName = 'message';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
});
// ============================== MESSAGES ==============================
$prefix         = 'order';
$controllerName = 'order';
Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
    $controller = ucfirst($controllerName)  . 'Controller@';
    Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
    Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
    Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
});
