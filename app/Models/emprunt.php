<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emprunt extends Model
{
    protected $table = 'emprunts';
    protected $fillable = [
        'utilisateure_id',
        'livre_id',
        'date_emp',
        'date_fin',
        'status',
    ];
    use HasFactory;
}
