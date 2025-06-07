<?php

namespace App\Http\Controllers;

use App\Models\DokumenPelaksanaanModel;
use App\Models\KriteriaModel;
use App\Models\PenetapanModel;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index($kriteria_nama, $jenis_kode)
    {
        switch (strtolower($jenis_kode)) {
            // case 'a':
                // $dokumen = DokumenPenetapan::where('kriteria', $kriteria)->get();
                // $label = 'Penetapan';
                // break;
            case 'b':
                $dokumen = DokumenPelaksanaanModel::where('kriteria_id', $kriteria_nama)->get();
                $label = 'Pelaksanaan';
                break;
            case 'c':
                // $dokumen = DokumenEvaluasi::where('kriteria', $kriteria)->get();
                // $label = 'Evaluasi';
                // break;
                // case 'd':
                //     $dokumen = DokumenPengendalian::where('kriteria', $kriteria)->get();
                //     $label = 'Pengendalian';
                //     break;
                // case 'e':
                //     $dokumen = DokumenPeningkatan::where('kriteria', $kriteria)->get();
                //     $label = 'Peningkatan';
                //     break;
            default:
                abort(404, 'Jenis dokumen tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Dokumen Kriteria',
            'list'  => ['Home', $dokumen, $label],
        ];

        $page = (object)[
            'title' => 'Dokumen Kriteria' . ($dokumen ? ' - ' . $label : ''),
        ];

        $activeMenu = 'Dokumen Akreditasi';

        return view('dokumen.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'label' => $label,
            'kriteria_nama' => $kriteria_nama,
            'dokumen' => $dokumen,
            compact('dokumen', 'kriteria_nama', 'label')
        ]);
    }

     
}
