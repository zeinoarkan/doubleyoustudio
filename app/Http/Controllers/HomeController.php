<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data layanan
        $layanan = DB::table('layanan')->get();

        // Mengarah ke resources/views/pages/home.blade.php
        return view('pages.home', compact('layanan'));
    }
}