<?php

namespace App\Http\Controllers;

use App\Models\Utilisateure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function dashbord ()
    {
        $user = Auth::user();
        $users = Utilisateure::all();
        return view('superAdmin.dashbord',compact('user','users'));
    }
    public function showAdmin()
    {
        return view('superAdmin.addadmin');
    }
    public function addAdmin(Request $request)
    {
        $info = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:utilisateures,email',
            'phone' => 'required|numeric|min:10',
            'adress' => 'required',
            'CIN' => 'required',
            'gender' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($info)
        {
            Utilisateure::create([
                'username' => $info['username'],
                'email' => $info['email'],
                'phone' => $info['phone'],
                'adress' => $info['adress'],
                'CIN' => $info['CIN'],
                'role' => 'Admin',
                'gender' => $info['gender'],
                'password' => Hash::make($info['password']),
            ]);
            return redirect()->route('viewlogin',['success'=>'You have successfully registered!']);
        }else
        {
            back();
        }
    }

    public function showSuper(){
        return view('superAdmin.addsuper');
    }

    public function addsuper(Request $request)
    {
        $info = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:utilisateures,email',
            'phone' => 'required|numeric|min:10',
            'adress' => 'required',
            'CIN' => 'required',
            'gender' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($info)
        {
            Utilisateure::create([
                'username' => $info['username'],
                'email' => $info['email'],
                'phone' => $info['phone'],
                'adress' => $info['adress'],
                'CIN' => $info['CIN'],
                'role' => 'superadmin',
                'gender' => $info['gender'],
                'password' => Hash::make($info['password']),
            ]);
            return redirect()->route('viewlogin',['success'=>'You have successfully registered!']);
        }else
        {
            back();
        }
    }
}
