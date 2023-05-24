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
Route::view('login/','auth.login')->name('viewlogin');
Route::post('login/',[\App\Http\Controllers\EtudiantController::class,'login'])->name('login');
Route::view('signup/','auth.signup')->name('viewsignup');
Route::post('signup/',[\App\Http\Controllers\EtudiantController::class,'signup'])->name('signup');
Route::get('profile/{id}',[\App\Http\Controllers\EtudiantController::class,'profile'])->name('profile')->middleware('auth');
Route::get('logout/',[\App\Http\Controllers\EtudiantController::class,'logout'])->name('logout')->middleware('auth');

Route::group(['middleware' => 'auth'],function (){
/* super admin */

Route::get('admin/users',[\App\Http\Controllers\SuperAdminController::class,'users'])
    ->name('super.users');
Route::view('admin/add/user','superAdmin.adduser')->name('admin.add.user');
Route::post('admin/add/user.vrf',[\App\Http\Controllers\SuperAdminController::class,'adduser'])
    ->name('admin.add.user.vrf');
Route::get('admin/user/change.role/{id}',function ($id){
    $user = \App\Models\Utilisateure::find($id);
    return view('superAdmin.change_role',compact('user'));
})->name('admin.change.user.rol');
Route::post('admin/user/change.role/{id}/vrf',[\App\Http\Controllers\SuperAdminController::class,'changerole'])
    ->name('admin.user.changerole');
Route::get('admin/user/delete/{id}',function ($id){
    $user = \App\Models\Utilisateure::find($id);
    return view('superAdmin.delete_user',compact('user'));
})->name('admin.user.delete');
Route::delete('admin/user/delete/{id}/vrf',[\App\Http\Controllers\SuperAdminController::class,'delete'])
    ->name('admin.user.delete.vrf');

});


Route::group(['middleware' => 'auth'],function (){
    /*  admin  */
    Route::get('moder/dashbord',[\App\Http\Controllers\AdminController::class,'dashbord'])
        ->name('moder.dashbord')->middleware('auth');
    Route::get('moder/profile',[\App\Http\Controllers\AdminController::class,'profileModer'])
        ->name('moder.profile')->middleware('auth');

    /*  admin.etudiant  */
    Route::get('moder/etudiant',[\App\Http\Controllers\AdminController::class,'listEtudiants'])
        ->name('moder.etudiant')->middleware('auth');
    Route::view('moder/etudiant/create','admin.create_student')
        ->name('moder.formCreateEtudient')->middleware('auth');
    Route::post('moder/etudiant/create/vrf',[\App\Http\Controllers\AdminController::class,'CreateEtudiant'])
        ->name('moder.etudiant.create')->middleware('auth');
    Route::delete('moder/etudiant/dellet/{id}',[\App\Http\Controllers\AdminController::class,'delletEtudiant'])
        ->name('moder.dellet.student')->middleware('auth');

    /*  admin.livre  */
    Route::get('moder/livres',[\App\Http\Controllers\AdminController::class,'listLivres'])
        ->name('moder.livre');
    Route::view('moder/livre/create','admin.create_livre')
        ->name('moder.livre.FormCreate');
    Route::post('moder/livre/create/vrf',[\App\Http\Controllers\AdminController::class,'createLivre'])
        ->name('moder.livre.create');
    Route::get('moder/livre/update/{id}',[\App\Http\Controllers\AdminController::class,'editLivre'])
        ->name('moder.livre.update');
    Route::post('moder/livre/update/{id}/vrf',[\App\Http\Controllers\AdminController::class,'updateLivre'])
        ->name('moder.livre.update.vrf');
    Route::get('moder/livre/delete/{id}',function ($id){
        $livre = \App\Models\Livre::find($id);return view('admin.delete_livre',compact('livre'));})
        ->name('moder.Formdelete.livre');
    Route::delete('moder/livre/delete/{id}',[\App\Http\Controllers\AdminController::class,'deleteLivre'])
        ->name('moder.livre.delete');
    Route::get('moder/livre/show/{id}',[\App\Http\Controllers\AdminController::class,'detailLivre'])
        ->name('moder.livre.show');
});





