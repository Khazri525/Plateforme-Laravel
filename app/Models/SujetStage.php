<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

//Relation
use App\Models\User;

class SujetStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sujet',
        'technologies',
        'description',
        'datedebut',
        'nom_dept',
        'typestage',
        'etatsujet',
       // 'stusujet',
        'periode',


        //Relation
       // 'matricule_sj',
     
    ];

    
        //relation dossier avec utilisateur
        public function getuser() {
            return $this->embedsOne(User::class);
            }




}
