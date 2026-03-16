<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesScolairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('classes_scolaires', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->unsignedInteger('capacite')->default(30);
        $table->foreignId('niveau_scolaire_id')
              ->constrained('niveaux_scolaires')
              ->onDelete('cascade');
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
        Schema::dropIfExists('classes_scolaires');
    }
}
