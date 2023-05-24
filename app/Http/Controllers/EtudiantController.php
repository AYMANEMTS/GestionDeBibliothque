<?php

namespace App\Http\Controllers;

use App\Models\Utilisateure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;

class EtudiantController extends Controller
{
    public function profile ($id)
    {
        $user = Utilisateure::findOrFail($id);
        return view('etudiant.profile',compact('user'));
    }
}
