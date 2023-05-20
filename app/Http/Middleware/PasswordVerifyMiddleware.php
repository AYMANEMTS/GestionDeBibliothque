<?php

namespace App\Http\Middleware;

use App\Models\Utilisateure;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class PasswordVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $password = $request->validate(['password'=>'required|string|min:8|max:30']);
            $user = Auth::user();
            if (!Hash::check($password, $user->password)) {
                return redirect()->route('viewlogin');
            }
        }

        return $next($request);
    }
}

