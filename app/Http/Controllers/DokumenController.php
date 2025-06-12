<?php

namespace App\Http\Controllers;

use App\Models\DokumenPelaksanaanModel;
use App\Models\KriteriaModel;
use App\Models\PenetapanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DokumenController extends Controller
{
    public function index($kriteria_nama, $jenis_list)
    {   
        switch (strtolower($jenis_list)) {
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
            'list'  => ['Home', $kriteria_nama, $label],
        ];

        $activeMenu = 'Dokumen Akreditasi';

        return view(
            'dokumen.index',
            compact('breadcrumb', 'kriteria_nama', 'activeMenu', 'dokumen', 'label', 'breadcrumb', 'activeMenu', 'jenis_list')
        );
    }
    public function store(Request $request, $kriteria_nama, $jenis_list)
    {
        if ($request->ajax() || $request->wantsJson()) {

            // Validasi awal kriteria
            $kriteria = KriteriaModel::where('kriteria_nama', $kriteria_nama)->first();
            if (!$kriteria) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kriteria tidak ditemukan.',
                    'msgField' => ['kriteria' => ['Kriteria tidak valid.']]
                ]);
            }

            // Ambil tipe dokumen dari request radio
            $tipe = $request->input('tipe_dokumen'); // 'file' atau 'link'

            $rules = [
                'description' => 'required',
                'tipe_dokumen' => 'required|in:file,link',
            ];

            if ($tipe === 'file') {
                $rules['file_pendukung'] = 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048';
            } elseif ($tipe === 'link') {
                $rules['link'] = 'required|url';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $filePath = null;
            if ($tipe === 'file' && $request->hasFile('file_pendukung')) {
                $filePath = $request->file('file_pendukung')->store('dokumen', 'public');
            }

            DokumenPelaksanaanModel::create([
                'kriteria_id' => $kriteria->kriteria_id,
                'description' => $request->input('description'),
                'link' => $tipe === 'link' ? $request->input('link') : null,
                'file_pendukung' => $filePath,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data dokumen berhasil disimpan'
            ]);
        }
        return redirect()->back();
    }
}
