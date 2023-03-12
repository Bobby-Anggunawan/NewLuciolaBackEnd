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
        Schema::create('lyrics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_table_songs');           //lagu dari lirik ini
            $table->unsignedSmallInteger('index');          //urutan di segmen ini(kalimat ke berapa ini di verse 1 misalnya)
            $table->enum('segmen', Enums::$lyricsSegment);  //verse, chorus, dll. Kalo ada lebih dari 1 verse misalnya, pakai kolom segmen_index
            $table->unsignedTinyInteger('segmen_index');    //angka di segmen misalnya berse 1, kolom ini nilainya 1, chorus 3, kolom ini nilainya 3
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
