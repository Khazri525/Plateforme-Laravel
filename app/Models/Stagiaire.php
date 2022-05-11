<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model as EloquentModel;


use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\DossierStage;
use App\Models\Rapport;
use App\Models\Bilan;
use App\Models\Travail;
use App\Models\DemandeStage;


use App\Models\Stagiaire;

use App\Notifications\ResetPasswordNotification;

class Stagiaire extends EloquentModel

{
    use HasFactory, Notifiable, HasApiTokens;


    protected $fillable = [
        
        'name',
        'prenom',
        'datenaissance',
        'email',
        'cinoupassport_stagiaire',
        //'passport',
        'niveauetude',
        'specialite',
        'filiere',
        'adresse',
        'telephone',
        'password',
         'etatSt',
     
         //relation avec demande de stage
         'DemandeStage',



        //relation avec travaux
          'Traveaux',
       

        
        //relation avec dossier de stage
         'DossierStage',

        //relation avec rapport
        'Rapport',

          //relation avec bilan
          'Bilan',
       
       



          //
         'dossiervalideSt',
        
    ];

    //Relation
    public function getdemandeStage() {
        return $this->embedsOne(DemandeStage::class);
    }


       //Relation
    public  function traveaux(){
        return $this->embedsMany(Travail::class);
        
     } 
  

     //relation avec dossier de stage

     public function getdossier() {
        return $this->embedsOne(DossierStage::class);
    }


     //relation avec rapport

     public function getrapport() {
        return $this->embedsOne(Rapport::class);
    }

    //relation avec bilan

    public function getbilan() {
            return $this->embedsOne(Bilan::class);
        }
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    
    public function sendPasswordResetNotification($token)
    {
        //https://spa.test   $url = 'http://localhost:3000/U-reset?token=' . $token;
        $url = 'http://localhost:3000/S-reset/' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }
}

