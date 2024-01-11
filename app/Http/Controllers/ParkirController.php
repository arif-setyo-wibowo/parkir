<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\Kategori;
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
            'parkir'  => Parkir::with("kategori")->where('status', 'cekin')->get(),
        ];
        return view('parkir',$data);
    }

    public function store(Request $request){
        $parkir = new Parkir;
        $parkir->idkategori = $request->idkategori;
        $parkir->merk = $request->merk;
        $parkir->nama_mobil = $request->nama_mobil;
        $parkir->warna = $request->warna;
        $parkir->plat = $request->plat;
        $parkir->save();
        Session::flash('msg', 'Berhasil Menambah Data Check In');
        return redirect()->route('parkir');
    }

    public function checkout(Request $request){
        $id = $request->query('id');
        $parkir = Parkir::find($id);
        $kategori = Kategori::find($parkir->idkategori);
        $parkir->total = max(1, now()->diffInDays($parkir->created_at)+1) * $kategori->harga;
        $parkir->status = 'cekout';
        $parkir->save();
        Session::flash('msg', 'Berhasil Melakukan Checkout');
        return redirect()->route('parkir');
    }
}