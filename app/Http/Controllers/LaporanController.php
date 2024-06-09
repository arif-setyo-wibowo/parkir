<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Parkir;
use App\Models\Keluar;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller
{
    function keluar(Request $request) {

        $data['title'] = "Laporan Kendaraan Keluar";

        $data['keluar'] = Keluar::with('parkir')->get();
        $data['total'] = 0;
        foreach ($data['keluar'] as $key => $value) {
            $data['total'] += $value['total'];
        }

        return view('laporan/laporan_kendaraan',$data);
    }
    function keluar_pdf(Request $request) {

        $masuk = $request->query('tgl_masuk');
        $keluar = $request->query('tgl_keluar');

        $data = Keluar::join('parkir', 'keluar.idparkir', '=', 'parkir.idparkir')
                ->join('kategori', 'parkir.idkategori', '=', 'kategori.idkategori')
                ->where('keluar.tgl_masuk', '>=', $masuk)
                ->where('keluar.tgl_keluar', '<=', $keluar)
                ->select('parkir.nama_mobil', 'parkir.merk', 'parkir.warna', 'parkir.nama_pemilik', 'parkir.tgl_masuk', 'keluar.tgl_keluar', 'keluar.total')
                ->get();


        $pdf = PDF::loadView('pdf.laporan_keluar', compact('data','masuk', 'keluar'));

        return $pdf->stream('laporan_keluar.pdf');
    }

    function masuk(Request $request){
        $data['title'] = "Laporan Kendaraan Masuk";

        $data['parkir'] = Parkir::with("kategori")->where('status', '0')->get();

        $data['total'] = 0;
        foreach ($data['parkir'] as $key => $value) {
            $data['total'] += $value['total'];
        }

        return view('laporan/laporan_kendaraan_masuk',$data);
    }

    function pendapatan(Request $request) {

        $data['title'] = "Laporan Pendapatan Kendaraan";

        return view('laporan/laporan_pendapatan',$data);
    }

    function pendapatan_user(Request $request) {

        $data['title'] = "Laporan Pendapatan by User";
        $data['user'] = User::all();

        return view('laporan/laporan_pendapatan_user',$data);
    }

    function pendapatan_kategori(Request $request) {

        $data['title'] = "Laporan Pendapatan by Kategori";
        $data['kategori'] = Kategori::all();

        return view('laporan/laporan_pendapatan_kategori',$data);
    }


}
