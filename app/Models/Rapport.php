<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
class Rapport extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rfile',
        
    
    ];
}
