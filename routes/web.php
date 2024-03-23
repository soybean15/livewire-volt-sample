<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
});


Volt::route('/counter', 'counter')->name('counter');
Volt::route('/login', 'auth.login');

Route::get('/logout', function(){
    if(Auth::user()){
        Auth::logout();
    }
   return  redirect('/');
});


Volt::route('/home', 'auth.login')->name('home')
->middleware('custom_auth');



Route::middleware(['custom_auth','role:admin'])->prefix('admin')->group(function(){
    Volt::route('/', 'admin')->name('admin');

});

Route::middleware(['custom_auth','role:teacher'])->prefix('teacher')->group(function(){
    Volt::route('/', 'teacher')->name('teacher');

});

Route::middleware(['custom_auth','role:student'])->prefix('student')->group(function(){
    Volt::route('/', 'home')->name('student');

});
