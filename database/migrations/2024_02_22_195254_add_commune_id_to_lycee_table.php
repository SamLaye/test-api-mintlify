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
        Schema::table('lycee', function (Blueprint $table) {
            $table->unsignedBigInteger('commune_id')->nullable(); // Ajouter la colonne commune_id à la table lycee
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lycee', function (Blueprint $table) {
            $table->dropColumn('commune_id'); // Supprimer la colonne commune_id lors de l'annulation de la migration
        });
    }
};
