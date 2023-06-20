<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SuperAdminController;
use App\Models\Livre;
use App\Models\Utilisateure;
use Illuminate\Support\Facades\Route;



/* Auth */
Route::view('/','')->name('home');
Route::view('login/','auth.login')->name('viewlogin');
Route::post('login/',[AuthenticationController::class,'login'])->name('login');
Route::view('signup/','auth.signup')->name('viewsignup');
Route::post('signup/',[AuthenticationController::class,'signup'])->name('signup');
Route::get('logout/',[AuthenticationController::class,'logout'])->name('logout')->middleware('auth');
Route::view('404','error404')->name('404');
//Route::get('/password/reset', [AuthenticationController::class,'showResetForm'])->name('password.reset');
//Route::post('/password/email', [AuthenticationController::class,'sendResetLinkEmail'])->name('password.email');
//Route::get('/password/reset/{token}', [AuthenticationController::class,'showResetPasswordForm'])->name('password.reset.form');
//Route::post('/password/reset', [AuthenticationController::class,'resetPassword'])->name('password.reset.submit');
//


Route::get('',[EtudiantController::class,'dash_pub'])->name('dash_pub');
Route::get('livre/{id}',[EtudiantController::class,'livre_pub'])->name('livre_pub');
Route::get('Posts/',function (){
    $posts = \App\Models\Post::where('status','accepter')->paginate(8);
    return view('etudiant.public.posts_pub',compact('posts'));
})->name('posts_pub');
Route::get('Post/{id}',function ($id){
    $post = \App\Models\Post::findOrFail($id);
    return view('etudiant.public.post_show_pub',compact('post'));
})->name('post_show_pub');

/* Etudiant */
Route::group(['middleware' => ['auth']],function (){
   Route::controller(EtudiantController::class)->group(function (){
       /* Etudiant profile*/
       //Route::view('/','etudiant.index')->name('hompage');
       Route::get('Mydashbord/','dashbord')->name('Mydashbord');
       Route::get('mes_emprunts/','mes_emprunts')->name('mes_emprunts');
       Route::get('profile/{id}','profile')->name('profile');
       Route::get('profile/{id}/edit','editprofile')->name('editprofile');
       Route::put('profile/{id}/edit','updateprofile')->name('updateprofile');
       Route::get('profile/{id}/changepassword','rstpass')->name('rstpass');
       Route::post('profile/{id}/changepassword','changepass')->name('changepass');

       /* Etudiant livres*/
       Route::get('livres','books')->name('books');
       Route::get('livres/detail/{id}','showbook')->name('detail');
       Route::post('livre/{id}/emprunt','empruntlivre')->name('empruntunlivre');

       Route::delete('delete/emprunt/{id}','deleteEmprunt')->name('deleteEmprunt');

       Route::get('messages/','messages')->name('messages');
       Route::delete('messages/delete/{id}','deleteMessage')->name('deleteMessage');

       Route::get('myPost/','myPost')->name('myPost');
   });
});
Route::post('/like', [PostController::class,'like'])->name('posts.like');
Route::post('/deslike',[PostController::class,'deslike'])->name('posts.deslike');
Route::post('/like/comment', [ComentController::class,'likeComment'])->name('comment.like');
Route::post('/dislike/comment', [ComentController::class,'dislikeComment'])->name('comment.dislike');

Route::view('Blog/post/create','etudiant.posts.post_create')->name('Post.create')->middleware('auth');
Route::post('submit/',[ComentController::class,'store'])->name('coment.store');
Route::post('submit-child/',[ComentController::class,'storeChild'])->name('coment.storeChild');
Route::post('update-cmnt/{id}',[ComentController::class,'update'])->name('coment.update');
Route::get('update-cmnt/{id}',[ComentController::class,'destroy'])->name('coment.destroy');



Route::post('/like', [PostController::class,'like'])->name('posts.like');




Route::get('python',function (){
    $path = 'D:\Laravel-Project\gestionDeBibliothec\GestionDeBibliotheque\public\pyscript.py';
    $output = [];
    exec("python {$path} ", $output);
    return $output;
});


Route::group(['middleware' => ['auth']],function (){
    Route::controller(PostController::class)->group(function (){
        Route::get('Blog/posts','index')->name('Post.index');
        Route::get('Blog/post/{id}','show')->name('Post.show');
        Route::post('Blog/post/store','store')->name('Post.store');
        Route::get('Blog/post/edit/{id}','edit')->name('Post.edit');
        Route::post('Blog/post/edit/{id}','update')->name('Post.update');
        Route::get('Blog/post/delete/{id}','destroy')->name('Post.destroy');

    });
});





/* Super Admin */
Route::group(['middleware' => ['auth','chek.role.etd','chek.role.mdr']],function (){
    Route::controller(SuperAdminController::class)->group(function (){
        Route::prefix('admin/')->name('admin.')->group(function (){
            Route::get('users','users')->name('users');
            Route::view('add/user','superAdmin.adduser')->name('add.user');
            Route::post('add/user','adduser')->name('add.user.vrf');
            Route::get('user/change.role/{id}',function ($id){
                $user = Utilisateure::find($id);
                return view('superAdmin.change_role',compact('user'));
            })->name('change.user.rol');
            Route::post('user/change.role/{id}','changerole')->name('user.changerole');
            Route::get('user/delete/{id}',function ($id){
                $user = Utilisateure::find($id);
                return view('superAdmin.delete_user',compact('user'));
            })->name('user.delete');
            Route::delete('user/delete/{id}','delete')->name('user.delete.vrf');
        });
    });
});


/*  Admin  */
Route::group(['middleware' => ['auth','chek.role.etd']],function (){
    Route::controller(AdminController::class)->group(function (){
       Route::name('moder.')->prefix('moder/')->group(function (){
           Route::get('dashbord','dashbord')->name('dashbord');
           Route::get('profile','profileModer')->name('profile');

           /*  admin.etudiant  */
           Route::get('etudiant','listEtudiants')->name('etudiant');
           Route::view('etudiant/create','admin.create_student')->name('formCreateEtudient');
           Route::post('etudiant/create','CreateEtudiant')->name('etudiant.create');
           Route::delete('etudiant/dellet/{id}','delletEtudiant')->name('dellet.student');

           /*  admin.livre  */
           Route::get('livres','listLivres')->name('livre');
           Route::view('livre/create','admin.create_livre')->name('livre.FormCreate');
           Route::post('livre/create','createLivre')->name('livre.create');
           Route::get('livre/update/{id}','editLivre')->name('livre.update');
           Route::post('livre/update/{id}','updateLivre')->name('livre.update.vrf');
           Route::get('livre/delete/{id}',function ($id){
               $livre = Livre::find($id);return view('admin.delete_livre',compact('livre'));})
               ->name('Formdelete.livre');
           Route::delete('livre/delete/{id}','deleteLivre')->name('livre.delete');
           Route::get('livre/show/{id}','detailLivre')->name('livre.show');

           Route::post('emprunts/accept/{id}','acceptEmprunt')->name('emprunt.accepter');
           Route::get('emprunts','emprunts')->name('emprunts');
           Route::post('emprunts/refuse/{id}','refuseEmprunt')->name('emprunt.refuse');
           Route::delete('emprunts/{id}/delete','deleteEmprunt')->name('emprunt.delete');
           Route::post('emprunt/rendu/{id}','renduEmprunt')->name('renduEmprunt');

           // return posts
           Route::get('posts/accepter','postsacc')->name('postsacc');
           Route::get('posts/enattend','postsatt')->name('postsatt');
           Route::get('post/{id}','postshow')->name('postshow');

           // back
           Route::get('post/{id}/accept','acceptPost')->name('acceptPost');
           Route::get('post/{id}/refuse','refusePost')->name('refusePost');

       });
    });
});



Route::post('upload-image', [PostController::class, 'upload'])->name('upload.image');

Route::view('test','test');

