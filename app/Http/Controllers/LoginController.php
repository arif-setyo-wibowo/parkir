<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data=[
            'title' => "Dashboard"
        ];
        // session()->flush();
        return view('login',$data);
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Username admin harus diisi.',
            'username.username' => 'Username admin tidak valid.',
            'password.required' => 'Kata sandi admin harus diisi.',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user) {
            if (password_verify($request->password, $user->password)) {
                session()->flush();

                // Set common session variables
                session([
                    'user.id' => $user->id,
                    'user.username' => $user->username,
                    'user.nama' => $user->nama,
                ]);

                // Set role-specific session variables and redirect
                if ($user->role == 0) {
                    session(['admin' => true]);
                    session(['user.role' => 'admin']);
                    return redirect()->route('dashboard.admin');
                } elseif ($user->role == 1) {
                    session(['petugas' => true]);
                    session(['user.role' => 'petugas']);
                    return redirect()->route('dashboard.petugas');
                } elseif($user->role == 2){
                    session(['keuangan' => true]);
                    session(['user.role' => 'keuangan']);
                    return redirect()->route('dashboard.keuangan');
                }
            } else {
                return redirect()->route('login')->withErrors(['error' => 'Password salah'])->withInput();
            }
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Email tidak ditemukan'])->withInput();
        }
    }

    public function logout (Request $request){
        session()->forget('admin');
        session()->forget('user.id');
        session()->forget('user.username');
        session()->forget('user.nama');
        session()->forget('user.role');
        return redirect()->route('login');
    }
    public function logout_petugas(){
        session()->forget('petugas');
        session()->forget('user.id');
        session()->forget('user.username');
        session()->forget('user.nama');
        session()->forget('user.role');
        return redirect()->route('login');
    }
    public function logout_keuangan(){
        session()->forget('keuangan');
        session()->forget('user.id');
        session()->forget('user.username');
        session()->forget('user.nama');
        session()->forget('user.role');
        return redirect()->route('login');
    }
}
