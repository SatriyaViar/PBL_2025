<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class PPEPController extends Controller
{
    private $jenis_list = [
        'A' => ['title' => 'Penetapan', 'color' => 'primary', 'icon' => 'fa-bullseye'],
        'B' => ['title' => 'Pelaksanaan', 'color' => 'success', 'icon' => 'fa-tasks'],
        'C' => ['title' => 'Evaluasi', 'color' => 'info', 'icon' => 'fa-chart-line'],
        'D' => ['title' => 'Pengendalian', 'color' => 'warning', 'icon' => 'fa-cogs'],
        'E' => ['title' => 'Peningkatan', 'color' => 'danger', 'icon' => 'fa-arrow-up']
    ];


    public function index($id)
    {
        $kriteria = KriteriaModel::find($id);
        $kriteria_nama = $kriteria ? $kriteria->kriteria_nama : 'Tidak Ditemukan';

        $breadcrumb = (object)[
            'title' => 'Kriteria Dokumen',
            'list'  => ['Home', 'Kriteria', $kriteria_nama ?? 'Semua'],
        ];

        
        $page = (object)[
            'title' => 'Kriteria Akreditasi' . ($kriteria_nama ? ' - ' . $kriteria_nama : ''),
        ];

        $activeMenu = 'Kriteria Dokumen';

        return view('ppep.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'jenis_list' => $this->jenis_list,
            'kriteria_nama' => $kriteria_nama,
        ]);
    }
}
