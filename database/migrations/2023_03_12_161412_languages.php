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
        //tabel untuk menampung daftar bahasa
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('flag');                     //foto bendera bahasa ini(kalo bisa kotak)
            $table->string('background');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
