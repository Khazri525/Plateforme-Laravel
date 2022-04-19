<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagiairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('prenom'); 
            $table->date('datenaissance');
            $table->string('email')->unique();
            $table->integer('cinoupassport_stagiaire'); 
           // $table->integer('passport'); 
            $table->string('niveauetude');
            $table->string('specialite');
            $table->string('filiere');
            $table->string('adresse'); 
            $table->numeric('telephone');
              //Relation
              $table->array('demandeStages'); 


              //Relation2
              $table->array('traveaux'); 
            $table->string('password');
            $table->string('password_confirmation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stagiaires');
    }
}
