<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Repository\Data\Enums;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->text('word');
            $table->bigInteger('id_table_languages');   //id dari table languages, sesuai kata ini
            $table->string('background')->nullable();   //foto yang menggambarkan kata ini
            $table->enum('penguasaan', Enums::$penguasaanKata);
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
