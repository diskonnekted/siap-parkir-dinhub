<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            return redirect()->route('admin.home');
        }
        return view('admin.login', [
            'action' => route('admin.login.cek'),
            'button' => 'Login',
        ]);
    }

    public function cek(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'actived' => 1])) {
            $request->session()->regenerate();

            session([
                'id_users' => Auth::user()->id_users,
                'username' => Auth::user()->username,
                'nama' => Auth::user()->nama,
                'level' => Auth::user()->level,
                'tahun' => date('Y'),
            ]);

            return redirect()->route('admin.home');
        }

        return redirect()->route('admin.login')->with('message', 'Username dan Password tidak sesuai!!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
