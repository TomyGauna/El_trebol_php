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
        Schema::table('news', function (Blueprint $table) {
        $table->string('image')->nullable();
        $table->string('image_2')->nullable();
        $table->string('image_3')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Elimina la columna 'image' si existe
            $table->dropColumn('image');
            $table->dropColumn('image_2');
            $table->dropColumn('image_3');
        });
    }
};
