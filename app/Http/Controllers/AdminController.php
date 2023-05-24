<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Utilisateure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashbord ()
    {
        $user = Auth::user();
        return view('admin.dashbord',compact('user'));
    }

    public function profileModer(Request $request)
    {
        $user = Auth::user();
        if ($request->has('update')){
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'CIN' => $request->CIN,
                'adress' => $request->adress
            ]);

        }
        return view('admin.moder_profile',compact('user'));

    }
    /* Moder  Etudiant */
    public function listEtudiants()
    {
        $etd = Utilisateure::paginate(7);
        return view('admin.etudiant',compact('etd'));
    }
    public function CreateEtudiant(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:utilisateures,email',
            'phone' => 'required|numeric|min:10',
            'adress' => 'required',
            'CIN' => 'required',
            'gender' => 'required',
            'password' => 'required|confirmed',
        ]);
        if($data){
            Utilisateure::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'adress' => $data['adress'],
                'CIN' => $data['CIN'],
                'role' => 'etudiant',
                'gender' => $data['gender'],
                'password' => Hash::make($data['password']),
            ]);
            return redirect()->route('moder.etudiant',['success'=>'Etudiant was created successfuly']);
        }else{
            back();
        }
    }
    public function delletEtudiant($id)
    {
        $user = Utilisateure::find($id);
        $user->delete();
        return back()->with(['done'=>'etudiant was delleted succcessfuly']);

    }

    /* Moder  Livres */
    public function listLivres()
    {
        $livre = Livre::paginate(8);
        return view('admin.livres',compact('livre'));
    }
    public function createLivre(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required',
            'autheur' => 'required',
            'launge' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'annee' => 'required',
            'dispo' => 'in:true,false',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $dispo = $request->has('dispo') ? true : false;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_Livres'),$imagePath);


        }
        if($data){
            Livre::create([
                'titre' => $data['titre'],
                'autheur' => $data['autheur'],
                'launge' => $data['launge'],
                'categorie' => $data['categorie'],
                'description' => $data['description'],
                'dispo' => $dispo,
                'annee' => $data['annee'],
                'image' => $imagePath ,
            ]);
            return redirect()->route('moder.livre')->with('success', 'Livre created successfully');
        }
    }

    public function editLivre($id)
    {
        $livre = Livre::find($id);
        return view('admin.update_livre',compact('livre'));
    }
    public function updateLivre(Request $request ,$id)
    {
        $data = $request->validate([
            'titre' => 'required',
            'autheur' => 'required',
            'launge' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'annee' => 'required',
            'dispo' => 'in:true,false',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $dispo = $request->has('dispo') ? true : false;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_Livres'), $imagePath);
        }

        $livre = Livre::findOrFail($id);
        $livre->update([
            'titre' => $data['titre'],
            'autheur' => $data['autheur'],
            'launge' => $data['launge'],
            'categorie' => $data['categorie'],
            'description' => $data['description'],
            'dispo' => $dispo,
            'annee' => $data['annee'],
            'image' => $imagePath ,
        ]);
        return redirect()->route('moder.livre')->with(['done'=>'livre est modified']);
    }
    public function deleteLivre($id)
    {
        $livre = Livre::findOrFail($id);
        $livre->delete($id);
        return redirect()->route('moder.livre');
    }
    public function detailLivre($id)
    {
        $livre = Livre::findOrFail($id);
        return view('admin.livre_detail',compact('livre'));
    }


}
