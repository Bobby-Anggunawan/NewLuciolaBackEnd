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
        Schema::create('lyrics_contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_table_lyrics');           //lirik yang mengandung kata ini
            $table->unsignedSmallInteger('index');          //urutan kata di lirik ini
            $table->bigInteger('id_table_words');   //kata di lirik ini
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
