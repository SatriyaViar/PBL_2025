<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        // Tambahkan data yang diperlukan
        $countdosen = 0; // Ganti dengan query database yang sesuai
        // Contoh: $countdosen = User::where('role', 'dosen')->count();

        return view('dashboard.index', compact('breadcrumb', 'activeMenu'));
    }
}
