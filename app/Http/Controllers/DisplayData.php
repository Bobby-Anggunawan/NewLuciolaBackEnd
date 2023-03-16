<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller untuk route yang berfungsi untuk membaca data yang akan ditampilkan di UI
 *
 * Long description for class (if any)...
 *
 * @copyright  2023 Bobby Anggunawan
 * @license    http://www.zend.com/license/3_0.txt   PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://dev.zend.com/package/PackageName
 * @since      Class available since Release 1.2.0
 */ 
class DisplayData extends Controller
{
    //di halaman daftar kata untuk pilih bahasa
    function getDaftarBahasa(){
        throw new Exception("Belum diimplementasikan");
    }

    function generateWordOfTheHour($idBahasa){
        throw new Exception("Belum diimplementasikan");
    }

    //di halaman daftar kata. fungsi ini hanya menampilkan maksimal beberapa kata karena ada fitur acak jadi gak bisa semua kata karena gabisa dipaging
    function getWordList($idBahasa){
        throw new Exception("Belum diimplementasikan");
    }

    //di popup arti kata yang muncul kalau item kata di daftar kata ditekan
    function getWord($idWord){
        throw new Exception("Belum diimplementasikan");
    }

    //di halaman daftar lagu
    function getSongList($idBahasa){
        throw new Exception("Belum diimplementasikan");
    }

    //di halaman lirik lagu
    function getSongLyrics($idSong){
        throw new Exception("Belum diimplementasikan");
    }
}
