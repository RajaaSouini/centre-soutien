<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
{
    Schema::create('paiements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('inscription_id')
              ->constrained('inscriptions')
              ->onDelete('cascade');
        $table->string('mois'); // ex: "Mars 2026"
        $table->decimal('montant', 8, 2);
        $table->enum('statut', ['Payé', 'Non payé'])->default('Non payé');
        $table->date('date_paiement')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('paiements');
}
}
