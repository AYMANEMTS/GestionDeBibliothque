<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('login/',[\App\Http\Controllers\UserController::class,'Vlogin'])->name('formlogin');
//Route::post('loogin/',[\App\Http\Controllers\UserController::class,'login'])->name('login');
//Route::get('register/',[\App\Http\Controllers\UserController::class,'signup'])->name('signup');
//Route::post('register/',[\App\Http\Controllers\UserController::class,'create'])->name('create');
//Route::get('dashbord/',[\App\Http\Controllers\UserController::class,'dashbord'])->name('dashbord');

/* Etudiant */

Route::view('/','etudiant.index')->name('hompage');
Route::view('login/','etudiant.login')->name('viewlogin');
Route::post('login/',[\App\Http\Controllers\EtudiantController::class,'login'])->name('login')->middleware('password.verify','role');
Route::view('signup/','etudiant.signup')->name('viewsignup');
Route::post('signup/',[\App\Http\Controllers\EtudiantController::class,'signup'])->name('signup');
Route::get('profile/{id}',[\App\Http\Controllers\EtudiantController::class,'profile'])->name('profile')->middleware('auth');
Route::get('logout/',[\App\Http\Controllers\EtudiantController::class,'logout'])->name('logout')->middleware('auth');



/* super admin */
Route::get('admin/dashbord',[\App\Http\Controllers\SuperAdminController::class,'dashbord'])->name('super.dashbord')->middleware('auth');
Route::get('admin/cree_super_moder',[\App\Http\Controllers\SuperAdminController::class,'showSuper'])->name('showSuper')->middleware('auth');
Route::post('admin/cree_super_moder/d',[\App\Http\Controllers\SuperAdminController::class,'addsuper'])->name('addsuper')->middleware('auth');
Route::get('admin/cree_moder',[\App\Http\Controllers\SuperAdminController::class,'showAdmin'])->name('moder.create')->middleware('auth');
Route::post('admin/cree_moder/d',[\App\Http\Controllers\SuperAdminController::class,'addAdmin'])->name('moder.store')->middleware('auth');

/* admin */
Route::get('moder/dashbord',[\App\Http\Controllers\AdminController::class,'dashbord'])->name('moder.dashbord')->middleware('auth');
