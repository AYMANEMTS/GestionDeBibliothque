<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deslike extends Model
{
    protected $table = 'deslikes';
    protected $fillable = ['user_id','cmnt_id'];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
    public function comments()
    {
        return $this->belongsTo(Coment::class);
    }

    use HasFactory;
}
