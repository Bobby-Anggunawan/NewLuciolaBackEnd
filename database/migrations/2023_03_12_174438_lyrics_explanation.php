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
        Schema::create('lyrics_explanation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_table_lyrics');           //lirik yang ingin diartikan
            $table->bigInteger('id_table_languages');   //bahasa dari penjelasan ini
            $table->text('explanation');                //penjelasan lirik
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
