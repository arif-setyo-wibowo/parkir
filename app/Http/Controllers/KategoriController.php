<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=[
            'title' => "Kategori Kendaraan",
            'kategori' => Kategori::all()
        ];
        return view('kategori',$data);
    }

    public function storeUpdate(Request $request){
        if ($request->proses == 'Tambah') {
            $kategori = new Kategori;
            $kategori->kategori = $request->kategori;
            $kategori->harga = $request->harga;
            $kategori->save();
            Session::flash('msg', 'Berhasil Menambah Data Kategori');
            return redirect()->route('kategori');
        }elseif ($request->proses == 'Update') {
            $kategori = Kategori::find($request->idkategori);
            $kategori->kategori = $request->kategori;
            $kategori->harga = $request->harga;
            $kategori->save();
            Session::flash('msg', 'Berhasil Mengubah Data Kategori');
            return redirect()->route('kategori');
        }
    }

    public function destroy(Request $request){
        $id = $request->query('id');
        $kategori = Kategori::find($id);
        $kategori->delete();
        Session::flash('msg', 'Berhasil Menghapus Data Kategori');
        return redirect()->route('kategori');
    }
}