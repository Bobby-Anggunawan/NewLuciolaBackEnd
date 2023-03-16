<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputData extends Controller
{
    function inputKata($idBahasa, $fotoBackground, $listIdArti, $listPenjelasanKata){
        throw new Exception("Belum diimplementasikan");
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
