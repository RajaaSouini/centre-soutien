<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthToElevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('eleves', function (Blueprint $table) {
        $table->string('email')->nullable()->unique()->after('telephone');
        $table->string('password')->nullable()->after('email');
    });
}

public function down(): void
{
    Schema::table('eleves', function (Blueprint $table) {
        $table->dropColumn(['email', 'password']);
    });
}
}
