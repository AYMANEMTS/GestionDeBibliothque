<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
      'utilisateure_id','image','title','body','status'
    ];

    public function users()
    {
        return $this->belongsTo(Utilisateure::class,'utilisateure_id');
    }
}
