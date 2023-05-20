<?php

namespace App\Http\Controllers;

use App\Models\Utilisateure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function signup()
    {
        return view('auth.signup');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:utilisateures,email',
            'phone' => 'required|numeric|min:10',
            'adress' => 'required',
            'CIN' => 'required',
            'password' => 'required'
        ]);
        $data['password'] = Hash::make($data['password']);
        Utilisateure::create([
           'username' =>  $data['username'],
            'email' =>  $data['email'],
            'phone' =>  $data['phone'],
            'adress' =>  $data['adress'],
            'CIN' =>  $data['CIN'],
            'password' => $data['password'],
            'role' => 'admin'
        ]);
        return redirect()->route('formlogin');

    }
    public function dashbord()
    {
        return view('auth.dashbord');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Vlogin(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $data = ['email'=> $email , 'password' => $password];
        if (Auth::attempt($data)){
            $request->session()->regenerate();
            return to_route('dashbord');
        }else{
            return back()->withErrors(['error'=>'Email ou mot pass incorect'])->onlyInput('email');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
