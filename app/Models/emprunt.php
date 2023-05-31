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

    public function livre() {
        return $this->belongsTo(Livre::class);
    }
    public function user() {
        return $this->belongsTo(Utilisateure::class,'utilisateure_id');
    }

    public function periode($date_emp,$date_fin){
        $date_emp = strtotime($date_emp);
        $date_fin = strtotime($date_fin);
        $rentalPeriod = round(($date_fin - $date_emp) / (60 * 60 * 24));
        return abs($rentalPeriod);
    }


}
