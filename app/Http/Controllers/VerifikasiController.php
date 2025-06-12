<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Dokumen',
            'list'  => ['Home', 'Verifikasi']
        ];

        $page = (object)[
            'title' => 'Verifikasi Dokumen',
        ];

        $activeMenu = 'verifikasi';
        return view('verifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'level' => '']);
    }
}
