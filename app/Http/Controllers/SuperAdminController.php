<?php

namespace App\Http\Controllers;

use App\Models\Utilisateure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function users ()
    {
        $user = Auth::user();
        $users = Utilisateure::paginate(5);
        return view('superAdmin.users',compact('user','users'));
    }
    public function adduser(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:utilisateures,email',
            'phone' => 'required|numeric|min:10',
            'adress' => 'required',
            'CIN' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($data){
            Utilisateure::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'adress' => $data['adress'],
                'CIN' => $data['CIN'],
                'role' => $data['role'],
                'gender' => $data['gender'],
                'password' => Hash::make($data['password']),
            ]);
            return redirect()->route('admin.users')->with(['done'=>'user was add success']);
        }
    }

    public function changerole(Request $request , $id)
    {
        $user = Utilisateure::find($id);
        $role = $request->validate(['role'=>'required']);
        $user->update([
            'role' => $role['role']
        ]);
        return redirect()->route('admin.users');
    }

    public function delete($id)
    {
        $user = Utilisateure::find($id);
        $user->delete();
        return redirect()->route('admin.users');
    }
}
