<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateure extends Authenticatable
{
    protected $table = 'utilisateures';
    protected $fillable = ['username','email','phone','adress','CIN',
        'role','gender','password'];
    use HasFactory;
}

