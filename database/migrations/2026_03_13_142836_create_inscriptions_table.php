<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('inscriptions', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->enum('statut', ['En attente', 'Confirme', 'Refuse'])
              ->default('En attente');
        $table->decimal('prix', 8, 2)->nullable();
        $table->foreignId('eleve_id')
              ->constrained('eleves')
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
        Schema::dropIfExists('inscriptions');
    }
}
