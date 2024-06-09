<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\Kategori;
use App\Models\Keluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=[
            'title' => "Parkir Inap",
            'kategori'  => Kategori::all(),
            'parkir'  => Parkir::with("kategori")->where('status', '0')->get(),
        ];
        return view('parkir',$data);
    }
    public function show($id) {
        $data = [
            'title' => 'Detail Parkir',
            'parkir' => Parkir::find($id)->load("kategori")
        ];

        return view('cek-detail',$data);
    }

    public function store(Request $request){

        $total = Parkir::with("kategori")->where('status', '0')->count();

        if($total <= 45){
            $parkir = new Parkir;
            $parkir->idkategori = $request->idkategori;
            $parkir->merk = $request->merk;
            $parkir->nama_mobil = $request->nama_mobil;
            $parkir->warna = $request->warna;
            $parkir->plat = $request->plat;
            $parkir->telp = $request->telp;
            $parkir->nama_pemilik = $request->nama_pemilik;
            $imageData = $request->input('fotoData');
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $decodedImage = base64_decode($imageData);

            $imageName = $request->input('foto');
            $path = public_path('uploads/' . $imageName);
            file_put_contents($path, $decodedImage);

            $parkir->gambar = $imageName;
            $parkir->save();
            Session::flash('msg', 'Berhasil Menambah Data Check In');
            return redirect()->route('parkir');
        }else{
            Session::flash('msg', 'Parkiran Penuh');
            return redirect()->route('parkir');
        }

    }

    public function checkout(Request $request){
        $id = $request->query('id');
        $parkir = Parkir::find($id);

        $parkir->status = '1';
        $parkir->save();

        $keluar = new Keluar;
        $kategori = Kategori::find($parkir->idkategori);
        // $keluar->idkategori = $parkir->idkategori;
        $keluar->idparkir = $parkir->idparkir;
        $keluar->iduser = session('user.id');
        $keluar->total = max(1, now()->diffInDays($parkir->tgl_masuk)+1) * $kategori->harga;
        $keluar->tgl_masuk = $parkir->tgl_masuk;
        $keluar->tgl_keluar = date('Y-m-d H:i:s');
        // dd($keluar);
        $keluar->save();
        Session::flash('msg', 'Berhasil Melakukan Checkout');
        return redirect()->route('laporan.keluar');
    }
}
