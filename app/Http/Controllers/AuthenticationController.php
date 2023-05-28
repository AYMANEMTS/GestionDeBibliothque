<?php

namespace App\Http\Controllers;

use App\Models\Utilisateure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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
//    public function showResetForm()
//    {
//        return view('auth.reset');
//    }
//
//    public function sendResetLinkEmail(Request $request)
//    {
//        $request->validate(['email' => 'required|email']);
//
//        $response = $this->broker()->sendResetLink($request->only('email'));
//
//        if ($response === Password::RESET_LINK_SENT) {
//            return back()->with('status', trans($response));
//        }
//
//        return back()->withErrors(['email' => trans($response)]);
//    }
//
//    public function showResetPasswordForm($token)
//    {
//        return view('auth.reset-form', ['token' => $token]);
//    }
//
//    public function resetPassword(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required|confirmed|min:8',
//            'token' => 'required',
//        ]);
//
//        $response = $this->broker()->reset(
//            $request->only('email', 'password', 'password_confirmation', 'token'),
//            function ($user, $password) {
//                $user->password = bcrypt($password);
//                $user->save();
//            }
//        );
//
//        if ($response === Password::PASSWORD_RESET) {
//            return redirect()->route('login')->with('status', trans($response));
//        }
//
//        return back()
//            ->withInput($request->only('email'))
//            ->withErrors(['email' => trans($response)]);
//    }
//
//    protected function broker()
//    {
//        return Password::broker();
//    }

}
