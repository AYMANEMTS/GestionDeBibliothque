<?php

namespace App\Http\Controllers;

use App\Models\emprunt;
use App\Models\Livre;
use App\Models\Utilisateure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;

class EtudiantController extends Controller
{
    public function dashbord (){
        $user = Auth::user();
        $emp = emprunt::where('utilisateure_id',$user->id)->get();
        return view('etudiant.index',compact('emp'));
    }
    public function profile ($id)
    {
        $user = Utilisateure::findOrFail($id);
        if ($user->id == auth()->id()){
            return view('etudiant.profile.profile',compact('user'));
        }else{
            return redirect('404');
        }
    }
    public function editprofile($id)
    {
        $user = Utilisateure::findOrFail($id);
        if ($user->id == auth()->id()){
            return view('etudiant..profile.profile_edit',compact('user'));
        }else{
            return redirect('404');
        }
    }
    public function updateprofile(Request $request ,$id)
    {
        $user = Utilisateure::findOrFail($id);
        $data = $request->post();
        if ($request->hasFile('profile_img')){
            $image = $request->file('profile_img');
            $imagePath = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_profiles'),$imagePath);
            $data['profile_img'] = $imagePath;
            $user->update([
                'profile_img' => $data['profile_img']
            ]);
        }
        $user->update([
            'username' => $data['username'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'CIN' => $data['CIN'],
            'adress' => $data['adress'],
            'phone' => $data['phone'],
            'email' => $data['email'],

        ]);
        return redirect()->route('profile',$user->id);

    }
    public function rstpass($id)
    {
        $user = Utilisateure::find($id);
        return view('etudiant.profile.profile_change_pssword',compact('user'));
    }
    public function changepass(Request $request,$id)
    {
        $user = Utilisateure::find($id);
        $data = $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed'
        ]);
        if (Hash::check($data['currentPassword'] , $user->password )){
            $user->password = bcrypt($data['password']);
            $user->save();
            return redirect()->route('profile',$user->id)->with('success', 'Password changed successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Incorrect current password.']);
        }

    }
    public function books()
    {
        $book = Livre::all();
        return view('etudiant.livres.livres',compact('book'));
    }
    public function showbook($id)
    {
            $book = Livre::find($id);
            $empr = emprunt::where('livre_id',$book->id)->first();
            return view('etudiant.livres.detail',compact('book','empr'));
    }
    public function empruntlivre(Request $request ,$id)
    {
        $user = Auth::user();
        $livre = Livre::find($id);
        $emp = emprunt::where('utilisateure_id',$user->id)->get();
        if ($emp->count() >= 3){
            return redirect()->route('books')->withErrors(['error'=>'you much emprunt min is 3 emprunt']);
        }
        $date_emp = $request->input('date_emp');
        $date_fin = Carbon::parse($date_emp)->addDays(10);

        emprunt::create([
           'utilisateure_id' => $user->id,
           'livre_id' => $livre->id,
           'date_emp' => $date_emp,
           'date_fin' => $date_fin,
           'status' => 'attend'
        ]);
        return back()->with(['done'=>'Le livre a été emprunté avec succès
        Votre demande est en attente de confirmation.']);
    }
}


