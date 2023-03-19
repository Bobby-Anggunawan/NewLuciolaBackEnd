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

            $aFile = $request->file('background');
            if ($request->hasFile('background')) {
                $fotoBackgroundPath = $aFile->storeAs('images', $kata.$idBahasa.".".$aFile->getClientOriginalExtension());
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

    function inputLagu($idBahasa, $fotoCover, $judul, $namaPenyanyi){
        throw new Exception("Belum diimplementasikan");
    }

    //segmen di sini kayak verse, chorus
    //indeks di sini berapa posisi lirik ini di segmen ini
    function tambahBarisLirikLagu($idLagu, $listIdKata, $listArti, $segmen, $indeks){
        throw new Exception("Belum diimplementasikan");
    }
}
