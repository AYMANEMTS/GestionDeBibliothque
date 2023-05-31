<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msage extends Model
{
    use HasFactory;

    protected $table = 'msages';
    protected $fillable = ['msage','emprunt_id','utilisateure_id','status'];


}
