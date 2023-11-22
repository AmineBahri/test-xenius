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
        Schema::table('users', function (Blueprint $table) {
            $table->text('experience')->nullable();
            $table->text('comptences')->nullable();
            $table->text('formation')->nullable();
            $table->tinyInteger('is_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('experience');
            $table->dropColumn('comptences');
            $table->dropColumn('formation');
            $table->dropColumn('is_admin');
        });
    }
};
