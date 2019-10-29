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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * 以下为后台路由
 */
Route::get("/admin/login","Admin\LoginController@index");
Route::post("/admin/do_login","Admin\LoginController@doLogin");
Route::get("/admin/login_out","Admin\LoginController@loginOut");



Route::middleware(['check.admin.login','check.admin.power'])->prefix('admin')->group(function(){

    Route::get("/","Admin\IndexController@index");

    Route::resource("role","Admin\RoleController");

    Route::post("article/upload","Admin\ArticleController@upload");
    Route::post("article/edit_state","Admin\ArticleController@editState")->name('article.edit_state');
    Route::resource("article","Admin\ArticleController");

    Route::post('art_category/edit_state', "Admin\CategoryController@editState")->name('art_category.edit_state');
    Route::resource("art_category","Admin\CategoryController");

    Route::post("column/edit_state","Admin\ColumnController@editState")->name('column.edit_state');
    Route::resource("column","Admin\ColumnController");

    Route::get("template/{template}/get_by_type","Admin\TemplateController@getTemplateByType");
    Route::post("template/upload","Admin\TemplateController@upload");
    Route::post("template/edit_state","Admin\TemplateController@editState")->name('template.edit_state');
    Route::resource("template","Admin\TemplateController");

    Route::resource("power","Admin\PowerController");

    Route::post("adn/edit_state","Admin\AdminController@editState")->name('adn.edit_state');
    Route::resource("adn","Admin\AdminController");

    Route::post("user/edit_state","Admin\UserController@editState")->name('user.edit_state');
    Route::resource("user","Admin\UserController");

});