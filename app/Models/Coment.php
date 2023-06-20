<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{
    use HasFactory;

    protected $table = 'coments';
    protected $fillable = ['user_id','post_id','parent_id','body','likes','dislikes'];


    public function user()
    {
        return $this->belongsTo(Utilisateure::class);
    }

    public function replies()
    {
        return $this->hasMany(Coment::class, 'parent_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class,'cmnt_id');
    }
    public function deslikes()
    {
        return $this->hasMany(Deslike::class,'cmnt_id');
    }

    public function isLikedByLoggedInUserC()
    {
        return $this->likes->where('user_id', auth()->user()->id)->exists();
    }
}

