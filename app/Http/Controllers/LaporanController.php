<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parkir;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller
{
    function masukHarian(Request $request) {

        $data['title'] = "Laporan Masuk Harian Kendaraan";

        if ($request->query('tgl')) {
            $data['parkir'] = Parkir::with("kategori")->whereDate('created_at', $request->query('tgl'))->get();
        }else{
            $data['parkir'] = Parkir::with("kategori")->whereDate('created_at', date('Y-m-d'))->get();
        }

        return view('laporan/laporan_masuk_hari',$data);
    }

    function masukBulanan(Request $request){
        $data['title'] = "Laporan Masuk Bulanan Kendaraan";

        if ($request->query('bln') && $request->query('thn')) {
            $data['parkir'] = Parkir::with("kategori")->whereMonth('created_at', $request->query('bln'))->whereYear('created_at', $request->query('thn'))->get();
        }else{
            $data['parkir'] = Parkir::with("kategori")->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get();
        }

        return view('laporan/laporan_masuk_bulan',$data);
    }

    function keluarHarian(Request $request) {

        $data['title'] = "Laporan Keluar Harian Kendaraan";

        if ($request->query('tgl')) {
            $data['parkir'] = Parkir::with("kategori")->where('status', 'cekout')->whereDate('updated_at', $request->query('tgl'))->get();
        }else{
            $data['parkir'] = Parkir::with("kategori")->where('status', 'cekout')->whereDate('updated_at', now()->toDateString())->get();
        }

        $data['total'] = 0;
        foreach ($data['parkir'] as $key => $value) {
            $data['total'] += $value['total'];
        }

        return view('laporan/laporan_keluar_hari',$data);
    }

    function keluarBulanan(Request $request){
        $data['title'] = "Laporan Keluar Bulanan Kendaraan";

        if ($request->query('bln') && $request->query('thn')) {
            $data['parkir'] = Parkir::with("kategori")->where('status', 'cekout')->whereMonth('updated_at', $request->query('bln'))->whereYear('updated_at', $request->query('thn'))->get();
        }else{
            $data['parkir'] = Parkir::with("kategori")->where('status', 'cekout')->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year)->get();
        }

        $data['total'] = 0;
        foreach ($data['parkir'] as $key => $value) {
            $data['total'] += $value['total'];
        }

        return view('laporan/laporan_keluar_bulan',$data);
    }

    function ubahStatus(Request $request) {
        $id = $request->query('id');
        $parkir = Parkir::find($id);

        if ($parkir->status == 'cekin') {
            $parkir->status = 'cekout';
            $parkir->save();
        }else if ($parkir->status == 'cekout') {
            $parkir->status = 'cekin';
            $parkir->save();
        }
        Session::flash('msg', 'Berhasil Mengubah Status');
        return redirect()->back();
    }
}