<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data=[
            'title' => "Users",
            'user' => User::all()
        ];
        return view('users',$data);
    }

    public function storeUpdate(Request $request){
        if ($request->proses == 'Tambah') {
            $request->validate([
                'username' => 'unique:users',
            ]);
            $user = new User;
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
            Session::flash('msg', 'Berhasil Menambah Data User');
            return redirect()->route('users');
        }elseif ($request->proses == 'Update') {

            $user = User::find($request->id);

            $request->validate([
                'username'=> Rule::unique('users')->ignore($user->id)
            ]);

            if($request->password == null){
                $password = $request->password_lama;
            }else{
                $password = Hash::make($request->password);
            }

            if ($request->nama_user == null) {
                session(['nama.admin' => $user->nama_user]);
            }else{
                session()->forget('nama.admin');
                session(['nama.admin' => $request->nama_user]);
            }


            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->password = $password;
            $user->role = $request->role;
            $user->save();


            Session::flash('msg', 'Berhasil Mengubah Data User');
            return redirect()->route('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->query('id');
        $user = User::find($id);
        $user->delete();
        Session::flash('msg', 'Berhasil Menghapus Data User');
        return redirect()->route('users');
    }
}
