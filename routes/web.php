<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('tickets', 'TicketsController');

Route::post('close/{id}', 'TicketsController@close');

Route::post('comment', 'CommentsController@postComment');

Route::get('send-mail', function () {

    $details = [
        'title' => 'Test message',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('rkozlov340@gmail.com')->send(new \App\Mail\OrderShipped($details));

    dd("Email is Sent.");
});
