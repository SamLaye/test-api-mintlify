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
        Schema::table('departements', function (Blueprint $table) {
            $table->string('code_reg');
        });
        Schema::table('arrondissements', function (Blueprint $table) {
            $table->string('code_dept');
        });
        Schema::table('villages', function (Blueprint $table) {
            $table->string('code_com');
        });
        Schema::table('hopitaux', function (Blueprint $table) {
            $table->string('code_com');
        });
        Schema::table('lycee', function (Blueprint $table) {
            $table->string('code_com');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departements', function (Blueprint $table) {
            $table->dropColumn('code_reg');
        });
        Schema::table('arrondissements', function (Blueprint $table) {
            $table->dropColumn('code_dept');
        });
        Schema::table('villages', function (Blueprint $table) {
            $table->dropColumn('code_com');
        });
        Schema::table('hopitaux', function (Blueprint $table) {
            $table->dropColumn('code_com');
        });
        Schema::table('lycee', function (Blueprint $table) {
            $table->dropColumn('code_com');
        });
    }
};
