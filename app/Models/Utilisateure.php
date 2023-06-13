<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;

class Utilisateure extends Authenticatable
{
    use Notifiable;
    protected $table = 'utilisateures';
    protected $fillable = ['username','email','phone','adress','CIN','first_name','last_name','profile_img',
        'role','gender','password','countlivreRendu'];

    public function CountRendu()
    {
        $this->countlivreRendu++;
        $this->save();
    }
    use HasFactory;
}

