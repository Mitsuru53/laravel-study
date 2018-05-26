<?php

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');

Route::get('/tickets', 'TicketsController@index');
Route::get('/ticket/{slug?}', 'TicketsController@show');
Route::get('/ticket/{slug?}/edit', 'TicketsController@edit');
Route::post('/ticket/{slug?}/edit', 'TicketsController@update');
Route::post('/ticket/{slug?}/delete', 'TicketsController@destroy');

Route::get('sendmail', function () {
  $data = [
    'name' => 'Learning Laravel',
  ];
  Mail::send('emails.welcome', $data, function ($message) {
    $message->from('exhikkii@gmail.com', 'Learning Laravel');
    $message->to('exhikkii@icloud.com')->subject('Learning Laravel test email');
  });
  return "Your Email has been sent successfully";
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('home', 'PagesController@home');

Route::get('users/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('users/register', 'Auth\RegisterController@register');
Route::get('users/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('users/logout', 'Auth\LoginController@logout');

Route::get('users/{id?}/edit', 'UsersController@edit');
Route::post('users/{id?}/edit', 'UsersController@update');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'], function () {
  Route::get('users', ['as' => 'admin.user.index', 'uses' => 'UsersController@index']);
  Route::get('roles', 'RolesController@index');
  Route::get('roles/create', 'RolesController@create');
  Route::post('roles/create', 'RolesController@store');
  Route::get('/', 'PagesController@home');

  Route::get('posts', 'PostsController@index');
  Route::get('posts/create', 'PostsController@create');
  Route::post('posts/create', 'PostsController@store');
  Route::get('posts/{id?}/edit', 'PostsController@edit');
  Route::post('posts/{id?}/edit', 'PostsController@update');

  Route::get('categories', 'CategoriesController@index');
  Route::get('categories/create', 'CategoriesController@create');
  Route::post('categories/create', 'CategoriesController@store');
});

Route::get('/blog', 'BlogController@index');
Route::get('/blog/{slug?}', 'BlogController@show');
