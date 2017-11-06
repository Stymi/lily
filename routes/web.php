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
    return view('app');
});

/*
|--------------------------------------------------------------------------
| Web Routes 直播室管理 路由
|--------------------------------------------------------------------------
|
| 以下为文字直播室路由
|
*/

Route::get('expertManage/indexPage','admin\expertManageController@indexPage');
Route::get('expertManage/createPage','admin\expertManageController@createPage');
Route::get('expertManage/checkDefaultImg/{id}','admin\expertManageController@checkDefaultImg');
Route::post('expertManage/createExpertUser','admin\expertManageController@createExpertUser');


Route::get('imageManage/indexPage','admin\ImageController@indexPage');
Route::get('imageManage/uploadImagePage','admin\ImageController@uploadImagePage');
Route::get('imageManage/imageCategory','admin\ImageController@imageCategory');
Route::get('imageManage/imageCategoryList','admin\ImageController@imageCategoryList');

Route::post('imageManage/createImageCategory','admin\ImageController@createImageCategory');
Route::post('imageManage/createImageFile','admin\ImageController@createImageFile');
Route::post('imageManage/deleteImageFile','admin\ImageController@deleteImageFile');
Route::post('imageManage/getImageListByCatIDLimit','admin\ImageController@getImageListByCatIDLimit');



