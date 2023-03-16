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
            $table->binary('flag');                     //foto bendera bahasa ini(kalo bisa kotak)
            $table->timestamps();
        });

        //foto lain untuk bahasa ini. bisa pemandangan, makanan, dll
        DB::statement("ALTER TABLE languages ADD background MEDIUMBLOB NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
