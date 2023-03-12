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
        Schema::create('lyrics_contents_translation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_table_lyrics_contents');           //sebuah kata di lirik
            $table->bigInteger('id_table_words');   //artin dari sebuah kata di lirik
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
