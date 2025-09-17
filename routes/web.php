<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

// 2.1 4 verb
Route::get('/test-submit', function () {
    return view('test-submit');
});

Route::put('/update', function () {
    return 'Profile UPDATED';
});
Route::delete('/remove', function () {
    return 'Profil REMOVED';
});

Route::post('/submit', function () {
    return 'Post';
});

// 2.2 ROUTE GROUP
// admin page -> view student page, view lecture page, view employee page

Route::get('/admin/student', function(){
    return view('admin.student');
});
Route::prefix('admin')->group(function () {
    Route::get('/admin/lecture', function(){
        return view('admin.lecture');
    });
    Route::get('/admin/employee', function(){
        return view('admin.employee');
    });
});

// 2.3 route match
Route::match(['get', 'post'], '/feedback', function (\Illuminate\Http\Request $request) {
    if ($request->isMethod('post')) {
        return 'Form submitted';
    }
    return view('feedback');
});

// 2.4 passing data from view to routes
Route::get('/contact', function () {
    return view('contact');
});

Route::post('/submit-contact', function (Request $request) {
    $name = $request->input('name');

    return "Received name: $name";
});

//2.5 from route data to the view
Route::get('/users', function(){
    return view('users', ['name' => 'iota', 'age' => 18]);
});

//2.6 route parameters (so we will get the data from the url)

Route::get('/profile/{username}', function($username){
    return view('profile', ['name' => $username]);
});

// 2.7 route fallback
Route::fallback(function(){
    return response()-> view('fallback', [], 404);
});