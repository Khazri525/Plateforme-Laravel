<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class SujetStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sujet',
        'technologies',
        'description',


        'datedebut',
        'domaine',
        'typestage',
        'etatsujet',
        'periode',
        
    ];
}
