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

Route::group(['prefix'=>'/'],function (){
    Route::group(['prefix'=>'khoa'],function (){
        route::get('/','KhoaController@getview');
        route::get('/add','KhoaController@create');
        route::get('/edit/{id}','KhoaController@edit');
    });
    Route::group(['prefix'=>'khoahoc'],function (){
        route::get('/','KhoaHocController@getview');
        route::get('/add','KhoaHocController@create');
        route::get('/edit/{id}','KhoaHocController@edit');
        route::get('/{id}/ctrinhhoc','KhoaHocController@viewctrinhhoc');
        route::post('/monhoc','KhoaHocController@monhoc');
    });
    Route::group(['prefix'=>'chuyennganh'],function (){
        route::get('/','ChuyenNganhController@getview');
        route::get('/add','ChuyenNganhController@create');
        route::get('/edit/{id}','ChuyenNganhController@edit');
    });
    Route::group(['prefix'=>'monhoc'],function (){
        route::get('/','MonHocController@getview');
        route::get('/add','MonHocController@create');
        route::get('/edit/{id}','MonHocController@edit');
        route::post('/import','MonHocController@import');

    });
    Route::group(['prefix'=>'cthoc'],function (){
        route::get('/','CTHocController@getview');
        route::get('/add','CTHocController@create');
        route::get('/edit/{id}','CTHocController@edit');

    });
    Route::group(['prefix'=>'sinhvien'],function (){
        route::get('/','SinhvienController@index');
        route::get('/view/{id}','SinhvienController@getview');
        route::get('/add','SinhvienController@create');
        route::get('/edit/{id}','SinhvienController@edit');
        route::post('/import','SinhVienController@import');
    });
    Route::group(['prefix'=>'bangdiem'],function (){
        route::get('/','BangdiemController@getview');
        route::get('/add','BangdiemController@create');
        route::get('/edit/{id}','BangdiemController@edit');
        route::post('/import','BangdiemController@import');
    });
});
