<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');





Volt::route('/counter', 'counter')->name('counter');
Volt::route('/login', 'auth.login')->name('login')->middleware('guest');
Volt::route('/register', 'auth.register')->middleware('guest');

Route::get('/logout', function(){
    if(Auth::user()){
        Auth::logout();
    }
   return  redirect(route('login'));
});




Route::middleware(['custom_auth','role:admin'])->prefix('admin')->group(function(){
    Volt::route('/', 'admin')->name('admin');

});

Route::middleware(['custom_auth','role:teacher'])->prefix('teacher')->group(function(){
    Volt::route('/', 'teacher')->name('teacher');

});

Route::middleware(['custom_auth','role:student'])->prefix('student')->group(function(){
    Volt::route('/', 'home')->name('student');

});

