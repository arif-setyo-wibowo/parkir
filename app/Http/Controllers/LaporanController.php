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

        return view('laporan/laporan_kendaraan_masuk',$data);
    }

    function masuk_pdf(Request $request){
        $masuk = $request->query('tgl_masuk');
        $masukAkhir = $request->query('tgl_masuk_akhir');

        // dd($masuk, $masukAkhir);

        $data = Parkir::whereRaw('DATE(tgl_masuk) BETWEEN ? AND ?', [$masuk, $masukAkhir])
                ->where('status', '0')
                ->get();

        // Debug data yang diambil
        // dd($data);


        $pdf = PDF::loadView('pdf.laporan_masuk', compact('data','masuk','masukAkhir'));

        return $pdf->stream('laporan_masuk.pdf');
    }

    function pendapatan(Request $request) {

        $data['title'] = "Laporan Pendapatan Kendaraan";

        return view('laporan/laporan_pendapatan',$data);
    }

    function pendapatan_pdf(Request $request) {

        $bulan = $request->query('bln');
        $tahun = $request->query('thn');

        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $namaBulanDipilih = $namaBulan[$bulan];

        $dataKeluar = Keluar::join('parkir', 'keluar.idparkir', '=', 'parkir.idparkir')
                            ->whereMonth('keluar.tgl_keluar', $bulan)
                            ->whereYear('keluar.tgl_keluar', $tahun)
                            ->select('keluar.*', 'parkir.plat', 'parkir.nama_mobil', 'parkir.merk', 'parkir.warna', 'parkir.telp')
                            ->get();


        $totalPendapatan = $dataKeluar->sum('total');

        $pdf = PDF::loadView('pdf.laporan_pendapatan', compact('dataKeluar', 'totalPendapatan', 'namaBulanDipilih', 'tahun'));

        return $pdf->stream('laporan_pendapatan.pdf');
    }

    function pendapatan_user(Request $request) {

        $data['title'] = "Laporan Pendapatan by User";
        $data['user'] = User::all();

        return view('laporan/laporan_pendapatan_user',$data);
    }
    function pendapatan_user_pdf(Request $request) {

        $bulan = $request->query('bln');
        $tahun = $request->query('thn');
        $userId = $request->query('user');

        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $namaBulanDipilih = $namaBulan[$bulan];

        $dataKeluar = Keluar::join('parkir', 'keluar.idparkir', '=', 'parkir.idparkir')
                            ->join('users', 'keluar.iduser', '=', 'users.id')
                            ->whereMonth('keluar.tgl_keluar', $bulan)
                            ->whereYear('keluar.tgl_keluar', $tahun)
                            ->where('keluar.iduser', $userId)
                            ->select('keluar.*', 'parkir.plat', 'parkir.nama_mobil', 'parkir.merk', 'parkir.warna', 'parkir.telp', 'users.nama') // Sesuaikan dengan kolom yang diperlukan
                            ->get();

        $totalPendapatan = $dataKeluar->sum('total');

        $pdf = PDF::loadView('pdf.laporan_pendapatan_by_user', compact('dataKeluar', 'totalPendapatan', 'namaBulanDipilih', 'tahun'));

        return $pdf->stream('laporan_pendapatan_by_user.pdf');
    }

    public function pendapatan_kategori_pdf(Request $request)
    {
        $bulan = $request->query('bln');
        $tahun = $request->query('thn');
        $kategoriId = $request->query('kategori');

        $kategori = Kategori::find($kategoriId);
        $namaKategori = $kategori->kategori;
        $hargaKategori = $kategori->harga;


        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $namaBulanDipilih = $namaBulan[$bulan];

        $dataKeluar = Keluar::join('parkir', 'keluar.idparkir', '=', 'parkir.idparkir')
                            ->join('kategori', 'parkir.idkategori', '=', 'kategori.idkategori')
                            ->whereMonth('keluar.tgl_keluar', $bulan)
                            ->whereYear('keluar.tgl_keluar', $tahun)
                            ->where('kategori.idkategori', $kategoriId)
                            ->select('keluar.*', 'parkir.plat', 'parkir.nama_mobil', 'parkir.merk', 'parkir.warna', 'parkir.telp')
                            ->get();

        $totalPendapatan = $dataKeluar->sum('total');

        $pdf = PDF::loadView('pdf.laporan_pendapatan_by_kategori', compact('dataKeluar', 'totalPendapatan', 'namaBulanDipilih', 'tahun', 'namaKategori','hargaKategori' ));

        return $pdf->stream('laporan_pendapatan_by_kategori.pdf');
    }


    function pendapatan_kategori(Request $request) {

        $data['title'] = "Laporan Pendapatan by Kategori";
        $data['kategori'] = Kategori::all();

        return view('laporan/laporan_pendapatan_kategori',$data);
    }


}
