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
        Schema::table('noticias', function (Blueprint $table) {
            $table->unsignedBigInteger('mal_id')->nullable()->after('categoria');
            $table->string('tipo', 10)->nullable()->after('mal_id'); // 'anime' o 'manga'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dropColumn(['mal_id', 'tipo']);
        });
    }
};