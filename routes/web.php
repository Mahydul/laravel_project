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
});
Route::get('/contact',function(){
    return view('about',[
        'channel'=>"This is contact"
    ]);
});
Route::get('home',function(){
    echo "This is home page";
});
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