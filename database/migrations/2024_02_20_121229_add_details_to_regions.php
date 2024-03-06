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
        Schema::table('regions', function (Blueprint $table) {
            $table->float('superficie_km2')->nullable();
            $table->bigInteger('population_masculine')->nullable();
            $table->bigInteger('population_feminine')->nullable();
            $table->bigInteger('population')->nullable();
            $table->float('taux_scolarisation_globale')->nullable();
            $table->float('incidence_pauvrete')->nullable();
            $table->float('taux_alphabetisation_general')->nullable();
            $table->float('taux_enregistrement_etat_civil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn('superficie_km2');
            $table->dropColumn('population_masculine');
            $table->dropColumn('population_feminine');
            $table->dropColumn('population');
            $table->dropColumn('taux_scolarisation_globale');
            $table->dropColumn('incidence_pauvrete');
            $table->dropColumn('taux_alphabetisation_general');
            $table->dropColumn('taux_enregistrement_etat_civil');
        });
    }
};
