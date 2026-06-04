<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //hacer esto porque sino error de cambiar datos de binarios a string
        DB::table('usuarios')->update(['imagen_usuario' => 'avatarpordefecto.jpg']);

        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('imagen_usuario')->default('avatarpordefecto.jpg')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->binary('imagen_usuario')->nullable()->change();
        });
    }
};
