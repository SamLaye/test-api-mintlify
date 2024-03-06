<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code_vill');
            $table->unsignedBigInteger('commune_id');
            $table->float('superficie_km2')->nullable();
            $table->bigInteger('population_masculine')->nullable();
            $table->bigInteger('population_feminine')->nullable();
            $table->bigInteger('population')->nullable();
            $table->float('taux_scolarisation_globale')->nullable();
            $table->float('incidence_pauvrete')->nullable();
            $table->float('taux_alphabetisation_general')->nullable();
            $table->float('taux_enregistrement_etat_civil')->nullable();
            $table->float('densite')->nullable();
            $table->timestamps();

            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');;
        });
    }

    /**  
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
