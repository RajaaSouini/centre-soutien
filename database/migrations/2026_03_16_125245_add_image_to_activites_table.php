<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('activites', function (Blueprint $table) {
        $table->string('image')->nullable()->after('description');
    });
}

public function down(): void
{
    Schema::table('activites', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
}
