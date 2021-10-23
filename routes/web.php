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
//frontend
Route::get('/','Homecontroller@index');
Route::get('/shopbanhang','Homecontroller@index');

//Danh mục sản phẩm
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');

//thương hiệu sản phẩm
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandController@show_brand_home');



//backend
Route::get('/admin','Admincontroller@index');
Route::get('/dashboard','Admincontroller@show_dashboard');
Route::get('/logout','Admincontroller@logout');
Route::post('/admin-dashboard','Admincontroller@dashboard');

//category Product
Route::get('/add-category-product','CategoryProduct@add_category_product');

Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product'); //sửa danh mục
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product'); // xoá danh mục

Route::get('/all-category-product','CategoryProduct@all_category_product');


Route::post('/save-category_product','CategoryProduct@save_category_product');
Route::post('/update-category_product/{category_product_id}','CategoryProduct@update_category_product');
Route::post('/tim-kiem/category','CategoryProduct@seach');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');//Ẩn danh mục
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');//Hiện danh mục
//brandProduct
Route::get('/add-brand-product','BrandController@add_brand_product');

Route::get('/edit-brand-product/{brand_product_id}','BrandController@edit_brand_product'); //sửa danh mục
Route::get('/delete-brand-product/{brand_product_id}','BrandController@delete_brand_product'); // xoá danh mục

Route::get('/all-brand-product','BrandController@all_brand_product');


Route::post('/save-brand_product','BrandController@save_brand_product');
Route::post('/update-brand_product/{brand_product_id}','BrandController@update_brand_product');
Route::get('/tim-kiem/brand','BrandController@seach');

Route::get('/unactive-brand-product/{brand_product_id}','BrandController@unactive_brand_product');//Ẩn danh mục
Route::get('/active-brand-product/{brand_product_id}','BrandController@active_brand_product');//Hiện danh mục

//Product
Route::get('/add-product','ProductController@add_product');

Route::get('/edit-product/{product_id}','ProductController@edit_product'); //sửa danh mục
Route::get('/delete-product/{product_id}','ProductController@delete_product'); // xoá danh mục

Route::get('/all-product','ProductController@all_product');


Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');
Route::get('/tim-kiem','ProductController@seach');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');//Ẩn danh mục
Route::get('/active-product/{product_id}','ProductController@active_product');//Hiện danh mục
//Authentication roles
Route::get('/register-auth','AuthController@register_auth');
Route::get('/login-auth','AuthController@login_auth');
Route::get('/logout-auth','AuthController@logout_auth');
Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');

//user

Route::get('users','UserController@index');
Route::POST('Assign-roles','UserController@Assign_roles');
Route::POST('store-users','UserController@store_users');
Route::get('impersonate/{admin_id}','UserController@impersonate');
Route::get('impersonate_destroy','UserController@impersonate_destroy');
Route::get('delete-user-roles/{admin_id}','UserController@delete_user_roles');
Route::get('add-users','UserController@add_users');


Route::group(['middleware' => 'auth.roles' ] , function() {
    Route::get('/all-product','ProductController@all_product');
    Route::get('users','UserController@index');
});

//Order
Route::get('order','OrderController@order');
Route::get('view-order/{order_code}','OrderController@view_order');
Route::get('/tim-kiem','OrderController@seach');
Route::POST('order/fetch-data', 'OrderController@fetch_data');


//Customer
Route::get('customer','CustomerController@all_customer');
Route::get('add-customer','CustomerController@add_customer');
Route::POST('store-customer','CustomerController@store_customer');
Route::get('delete-customer/{customer_id}','CustomerController@delete-customer');






