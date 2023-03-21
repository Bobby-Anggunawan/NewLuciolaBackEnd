<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputData extends Controller
{
    function inputKata(Request $request){
        $kata = $request->input('word');
        $idBahasa = $request->input('id_table_languages');
        $penguasaan = $request->input('penguasaan');

        $listIdArti = json_decode($request->input('listIdArti'));
        $listPenjelasanKata = json_decode($request->input('listPenjelasanKata'));

        $suksesInsert = false;

        if(DB::table('words')->where("word", $kata)->where("id_table_languages", $idBahasa)->doesntExist()){

            //save
            $fotoBackgroundPath = null;

            if ($request->hasFile('background')) {
                $aFile = $request->file('background');
                $fotoBackgroundPath = $aFile->storeAs('images/word', $kata.$idBahasa.".".$aFile->getClientOriginalExtension());
            }

            $idWord = DB::table('words')->insert([
                'word' => $kata,
                'id_table_languages' => $idBahasa,
                'background' => $fotoBackgroundPath,
                'penguasaan' => $penguasaan
            ]);

            foreach ($listIdArti as $arti) {
                DB::table('word_translation')->insert([
                    'id_table_words_from' => $idWord,
                    'id_table_words_to' => $arti
                ]);
            }

            foreach ($listPenjelasanKata as $penjelasan) {
                DB::table('word_explanation')->insert([
                    'id_table_words' => $idWord,
                    'id_table_languages' => $penjelasan->{"bahasa"},
                    'explanation' => $penjelasan->{"penjelasan"}
                ]);
            }

            $suksesInsert = true;
        }

        $pesanReturn = "";
        if($suksesInsert){
            $pesanReturn = "Kata baru sukses dimasukkan";
        }
        else{
            $pesanReturn = "Tidak dapat memasukkan kata karena sudah ada di database";
        }

        return response()->json([
            'success' => $suksesInsert,
            'message' => $pesanReturn,
        ]);

    }

    function inputLagu(Request $request){
        $languages = $request->input('id_table_languages');
        $title = $request->input('title');
        $artist = $request->input('artist');

        $cover = null;
        if ($request->hasFile('cover')) {
            $aFile = $request->file('cover');
            $cover = $aFile->storeAs('images/cover', $title." - ".$artist.".".$aFile->getClientOriginalExtension());
        }

        $idLagu = DB::table('songs')->insert([
            'id_table_languages' => $languages,
            'title' => $title,
            'artist' => $artist,
            'cover' => $cover
        ]);
    }

    //segmen di sini kayak verse, chorus
    //indeks di sini berapa posisi lirik ini di segmen ini
    function tambahBarisLirikLagu(Request $request){

        //untuk di tabel lyrics_contents
        $idTabellyrics = $request->input('id_table_lyrics');

        //masukin ke tabel lyrics
        $id_table_songs = $request->input('id_table_songs');
        $index = $request->input('index');
        $segmen = $request->input('segmen');
        $segmen_index = $request->input('segmen_index');

        if(
            DB::table('lyrics')
                ->where("id_table_songs", $id_table_songs)
                ->where("index", $index)
                ->where("segmen", $segmen)
                ->where("segmen_index", $segmen_index)->exists()
        ){
            $idTabellyrics = DB::table('lyrics')->insert([
                'id_table_songs' => $id_table_songs,
                'index' => $index,
                'segmen' => $segmen,
                'segmen_index' => $segmen_index
            ]);
        }


        //list, masukkin satu persatu bersamaan
        $lyrics_contents = json_decode($request->input('lyrics_contents'));
        $lyrics_contents_translation = json_decode($request->input('lyrics_contents_translation'));

        echo $lyrics_contents;

        
        for ($x=0; $x<count((array)$lyrics_contents); $x++){

            $idkontenLirik = DB::table('lyrics_contents')->insert([
                'id_table_lyrics' => $idTabellyrics,
                'index' => $lyrics_contents[$x]->{"index"},
                'id_table_words' => $lyrics_contents[$x]->{"id_table_words"}
            ]);

            DB::table('lyrics_contents_translation')->insert([
                'id_table_lyrics_contents' => $idkontenLirik,
                'id_table_words' => $lyrics_contents_translation[$x]
            ]);

        }

        //list, masukkin satu persatu
        $lyrics_explanation = json_decode($request->input('lyrics_explanation'));

        foreach ($lyrics_explanation as $penjelasan){
            DB::table('lyrics_explanation')->insert([
                'id_table_lyrics' => $idTabellyrics,
                'id_table_languages' => $penjelasan->{"id_table_languages"},
                'explanation' => $penjelasan->{"explanation"},
            ]);
        }

    }
}
