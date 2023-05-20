<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $table = 'livres';
    protected $fillable =[
        'titre','autheur','description','launge','dispo',
        'image','annee','categorie'
    ];
    use HasFactory;
}
