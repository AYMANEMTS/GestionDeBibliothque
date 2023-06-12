<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
      'utilisateure_id','image','title','body','status','views'
    ];

    public function users()
    {
        return $this->belongsTo(Utilisateure::class,'utilisateure_id');
    }

    public function viewsCount() {
        // Check if the user has already viewed the post
        if (!session()->has('post_viewed_'.$this->id)) {
            // Increment the views count
            $this->views++;
            $this->save();

            // Mark the post as viewed by the user
            session()->put('post_viewed_'.$this->id, true);
        }

        return $this;
    }

    public function comments()
    {
        return $this->hasMany(Coment::class);
    }
}
