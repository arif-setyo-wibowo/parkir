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

    public function store(Request $request){

        $total = Parkir::with("kategori")->where('status', '0')->count();

        if($total <= 45){
            $parkir = new Parkir;
            $parkir->idkategori = $request->idkategori;
            $parkir->merk = $request->merk;
            $parkir->nama_mobil = $request->nama_mobil;
            $parkir->warna = $request->warna;
            $parkir->plat = $request->plat;
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

        $keluar->idkategori = $parkir->idkategori;
        $keluar->merk = $parkir->merk;
        $keluar->nama_mobil = $parkir->nama_mobil;
        $keluar->warna = $parkir->warna;
        $keluar->plat = $parkir->plat;
        $keluar->total = max(1, now()->diffInDays($parkir->tgl_masuk)+1) * $kategori->harga;
        $keluar->tgl_masuk = $parkir->tgl_masuk;
        $keluar->tgl_keluar = date('Y-m-d H:i:s');
        $keluar->save();
        Session::flash('msg', 'Berhasil Melakukan Checkout');
        return redirect()->route('laporan.stay');
    }
}