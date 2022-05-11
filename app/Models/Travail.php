<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Stagiaire;

class Travail extends Model
{
    use HasFactory;

    protected $fillable = [
        'tfile',
        'description',
    ];

     
    //relation dossier avec stagiaire
    public function getstagiaire() {
        return $this->embedsOne(Stagiaire::class);
        }
}
