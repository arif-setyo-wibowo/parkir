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
            'title' => "Users"
        ];
        return view('users',$data);
    }

    public function storeUpdate(Request $request){
        if ($request->proses == 'Tambah') {
            $user = new User;
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            Session::flash('msg', 'Berhasil Menambah Data User');
            return redirect()->route('users');
        }elseif ($request->proses == 'Update') {
            
            $user = User::find($request->iduser);
            $request->validate([
                'nama_user' => 'required',
                'level' => 'required',
                'username'=>[
                    'username',
                    Rule::unique('users')->ignore($user->id),
                ]
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
            $user->save();


            Session::flash('msg', 'Berhasil Mengubah Data User');
            return redirect()->route('users');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
