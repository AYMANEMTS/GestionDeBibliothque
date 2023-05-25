<?php

namespace App\Http\Controllers;

use App\Models\Utilisateure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login (Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $data = ['email'=> $email , 'password' => $password];
        if (Auth::attempt($data)){
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role == 'superadmin'){
                return redirect()->route('admin.users');
            }
            if ($user->role == 'admin'){
                return redirect()->route('moder.dashbord');
            }

            return redirect()->route('profile',$user->id);

        }else{
            return back()->withErrors(['error'=>'Email ou mot pass incorect'])->onlyInput('email');
        }

    }
    public function signup (Request $request)
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
                'role' => 'etudiant',
                'gender' => $info['gender'],
                'password' => Hash::make($info['password']),
            ]);
            return redirect()->route('viewlogin',['success'=>'You have successfully registered!']);
        }else
        {
            back();
        }
    }

    public function logout ()
    {
        Auth::logout();
        return redirect()->route('viewlogin');

    }

}
