<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register' , function() {
    $user = new User();
    $user->name = 'John Doe';
    $user->email = 'john@gmail.com';
    $user->password = Hash::make('internet');
    $user->save();
    $token = $user->createToken('bersoberry')->plainTextToken;
    return $token;
});
