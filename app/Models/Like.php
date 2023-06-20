<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','cmnt_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function comment()
    {
        return $this->belongsTo(Coment::class);
    }

}
