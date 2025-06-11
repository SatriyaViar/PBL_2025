<?php

namespace App\Http\Controllers;

use App\Models\DokumenPenetapanModel;
use App\Models\DokumenPelaksanaanModel;
use App\Models\DokumenEvaluasiModel;
use App\Models\DokumenPengendalianModel;
use App\Models\DokumenPeningkatanModel;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    // Untuk mapping jenis_list ke model dan label
    protected function getDokumenModelAndLabel($jenis_list)
{
    switch (strtolower($jenis_list)) {
        case 'penetapan':
        case 'a':
            return [DokumenPenetapanModel::class, 'Penetapan'];
        case 'pelaksanaan':
        case 'b':
            return [DokumenPelaksanaanModel::class, 'Pelaksanaan'];
        case 'evaluasi':
        case 'c':
            return [DokumenEvaluasiModel::class, 'Evaluasi'];
        case 'pengendalian':
        case 'd':
            return [DokumenPengendalianModel::class, 'Pengendalian'];
        case 'peningkatan':
        case 'e':
            return [DokumenPeningkatanModel::class, 'Peningkatan'];
        default:
            abort(404, 'Jenis dokumen tidak ditemukan');
    }
}


    public function index($kriteria, $jenis_list)
    {
        [$model, $label] = $this->getDokumenModelAndLabel($jenis_list);

        // Mengambil data kriteria berdasarkan nama
        $kriteriaModel = KriteriaModel::where('kriteria_nama', $kriteria)->firstOrFail();

        // Mengambil data dokumen berdasarkan kriteria_id
        $dokumens = $model::where('kriteria_id', $kriteriaModel->kriteria_id)->get();

        $breadcrumb = (object)[
            'title' => 'Dokumen Kriteria',
            'list'  => ['Home', $kriteria, $label],
        ];

        $activeMenu = 'Dokumen Akreditasi';

        return view('dokumen.index', [
            'breadcrumb' => $breadcrumb,
            'kriteria_nama' => $kriteria,
            'activeMenu' => $activeMenu,
            'dokumens' => $dokumens,
            'label' => $label,
            'jenis_list' => $jenis_list
        ]);
    }

    public function store(Request $request, $kriteria, $jenis_list)
    {
        try {
            // Cari kriteria berdasarkan nama
            $kriteriaModel = KriteriaModel::where('kriteria_nama', $kriteria)->firstOrFail();

            [$model, $label] = $this->getDokumenModelAndLabel($jenis_list);

            $tipe = $request->input('tipe_dokumen');

            $rules = [
                'description' => 'required|string',
                'tipe_dokumen' => 'required|in:file,link',
            ];

            if ($tipe === 'file') {
                $rules['file_pendukung'] = 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048';
            } elseif ($tipe === 'link') {
                $rules['link'] = 'required|url|max:255';
            }

            $validator = Validator::make($request->all(), $rules, [
                'description.required' => 'Deskripsi dokumen harus diisi',
                'file_pendukung.required' => 'File pendukung harus diupload',
                'file_pendukung.mimes' => 'Format file harus pdf, doc, docx, jpg, jpeg, atau png',
                'file_pendukung.max' => 'Ukuran file maksimal 2MB',
                'link.required' => 'Link harus diisi',
                'link.url' => 'Format link tidak valid',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ], 422);
            }

            $filePath = null;
            if ($tipe === 'file' && $request->hasFile('file_pendukung')) {
                $file = $request->file('file_pendukung');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('dokumen', $fileName, 'public');
            }

            $model::create([
                'kriteria_id' => $kriteriaModel->kriteria_id,
                'description' => $request->input('description'),
                'link' => $tipe === 'link' ? $request->input('link') : null,
                'file_pendukung' => $filePath,
                'jenis_list' => $jenis_list,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Dokumen berhasil disimpan',
                'redirect' => route('dokumen.index', ['kriteria' => $kriteria, 'jenis_list' => $jenis_list])
            ]);
        } catch (\Exception $e) {
            Log::error('Error in DokumenController@store: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
