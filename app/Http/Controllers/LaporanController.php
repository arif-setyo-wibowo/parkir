<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    function masukHarian() {
        
        $data=[
            'title' => "Laporan Masuk Harian Kendaraan"
        ];
        return view('laporan/laporan_masuk_hari',$data);
    }

    function masukBulanan(){
        $data=[
            'title' => "Laporan Masuk Bulanan Kendaraan"
        ];
        return view('laporan/laporan_masuk_bulan',$data);
    }

    function keluarHarian() {
        
        $data=[
            'title' => "Laporan Keluar Harian Kendaraan"
        ];
        return view('laporan/laporan_keluar_hari',$data);
    }

    function keluarBulanan(){
        $data=[
            'title' => "Laporan Keluar Bulanan Kendaraan"
        ];
        return view('laporan/laporan_keluar_bulan',$data);
    }
}
