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
        Schema::table('arrondissements', function (Blueprint $table) {
              // Renommer la colonne 'name' en 'nom'
              $table->renameColumn('name', 'nom');

              // Ajouter la nouvelle colonne 'densite'
              $table->float('densite')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arrondissements', function (Blueprint $table) {
            $table->renameColumn('nom', 'name');
            $table->dropColumn('densite');
        });
    }
};
