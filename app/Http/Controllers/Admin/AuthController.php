<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || sha1($request->password) !== $admin->password) {
            return back()->with('error', 'Username atau password salah');
        }

        session([
            'admin_logged_in' => true,
            'admin_id' => $admin->id_admin,
            'admin_username' => $admin->username,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang, ' . $admin->username . '!');
    }

    public function logout()
    {
        session()->flush();
    // Tambahkan with('success', ...)
    return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    }
}
