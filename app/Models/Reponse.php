<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = [

        'repimage',
        'reptext',
        'repcorrecte',
        'questions_id',
        
    ];
}
