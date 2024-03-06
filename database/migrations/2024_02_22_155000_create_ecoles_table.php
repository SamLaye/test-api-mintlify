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
        Schema::create('ecoles', function (Blueprint $table) {
            Schema::create('ecoles', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->string('adresse');
                $table->string('code_com');
                $table->unsignedBigInteger('commune_id');
                $table->timestamps();
    
                $table->foreign('commune_id')->references('id')->on('communes');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecoles');
    }
};
