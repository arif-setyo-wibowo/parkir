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
                    session(['admin' => true]);
                    session(['user.id' => $user->id]);
                    session(['user.admin' => $user->username]);
                    session(['nama.admin' => $user->nama]);
                    return redirect()->route('dashboard');
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
        session()->forget('user.admin');
        session()->forget('nama.admin');
        return redirect()->route('login');
    }
}
