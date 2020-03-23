<?php

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
Route::get('/about',function(){
    return view('about');
})->name('about');
Route::get('/contact',function(){
    return view('about',[
        'channel'=>"This is contact"
    ]);
});
Route::get('home',function(){
    echo "This is home page";
});
Route::get('/create','CategoriesController@create');
Route::post('/save-category','CategoriesController@saveData')->name('saveCategory');
Route::resource('categories', 'CategoriesController');
Route::get('/update-category', 'CategoriesController@update');
Route::get('/delete','CategoriesController@destroy');
Route::get('categories/destroy/{id}', 'CategoriesController@destroy');
Route::get('/inventory-type','InventoryTypeController@index');
Route::get('/uom-list','UnitOfMeasurementController@index');
Route::post('/uom-save','UnitOfMeasurementController@saveData')->name('saveUom');
Route::get('/uom-update','UnitOfMeasurementController@update');
Route::get('/uom-delete','UnitOfMeasurementController@delete');
//uom-delete
/*Route::group(['middleware'=>['age']],function(){
    Route::get('/about',function(){
        return view('about',[
            'channel'=>"This is about"
        ]);
    });
    Route::get('/contact',function(){
        return view('about',[
            'channel'=>"This is contact"
        ]);
    });
});*/

/*Route::prefix('shajalvoltage')->group(function(){
    Route::get('/about',function(){
        echo "this is about page";
    });
});*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
