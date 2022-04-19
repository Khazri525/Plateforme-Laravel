<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSujetStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sujet_stages', function (Blueprint $table) {
            $table->id();
            $table->string('sujet');
            $table->string('technologies');
            $table->mediumText('description');
            $table->string('datedebut');
            $table->string('domaine');
            $table->string('typestage');
            $table->string('etatsujet');
            $table->string('periode');
           
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
        Schema::dropIfExists('sujet_stages');
    }
}
