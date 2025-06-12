<?php

namespace App\Http\Controllers;

use App\Models\DokumenPelaksanaanModel;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $dokumens = DokumenPelaksanaanModel::where('kriteria_id', $kriteria_nama);
        return view(
            'dokumen.index',
            compact('breadcrumb', 'kriteria_nama', 'activeMenu', 'dokumen', 'label', 'breadcrumb', 'activeMenu', 'jenis_list', 'dokumens')
        );
    }

    public function list($kriteria_nama)
    {
        $dokumens = DokumenPelaksanaanModel::where('kriteria_id', $kriteria_nama)
            ->get();

        $dokumens->map(function ($item) {
            $item->file_url = $item->file_pendukung ? asset('storage/' . $item->file_pendukung) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'data' => $dokumens
        ]);
    }

    public function store(Request $request, $kriteria_nama, $jenis_list)
    {
        try {
            // Validasi kriteria
            $kriteria = KriteriaModel::where('kriteria_nama', $kriteria_nama)->first();
            if (!$kriteria) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kriteria tidak ditemukan.',
                    'msgField' => ['kriteria' => ['Kriteria tidak valid.']]
                ], 404);
            }

            $tipe = $request->input('tipe_dokumen');

            // Validasi input
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

            // Proses file jika ada
            $filePath = null;
            if ($tipe === 'file' && $request->hasFile('file_pendukung')) {
                $file = $request->file('file_pendukung');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('dokumen', $fileName, 'public');
            }

            // Simpan data
            DokumenPelaksanaanModel::create([
                'kriteria_id' => $kriteria->kriteria_id,
                'description' => $request->input('description'),
                'link' => $tipe === 'link' ? $request->input('link') : null,
                'file_pendukung' => $filePath,
                'jenis_list' => $jenis_list,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Dokumen berhasil disimpan',
                'redirect' => route('dokumen.index', ['kriteria' => $kriteria_nama, 'jenis_list' => $jenis_list])
            ]);
        } catch (\Exception $e) {
            Log::error('Error in DokumenController@store: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function preview($kriteria_nama, $jenis_list)
    {
        // Ambil data kriteria berdasarkan nama
        $kriteria = KriteriaModel::where('kriteria_nama', $kriteria_nama)->first();

        if (!$kriteria) {
            abort(404, 'Kriteria tidak ditemukan');
        }

        switch (strtolower($jenis_list)) {
            // case 'a':
            // $dokumen = DokumenPenetapan::where('kriteria', $kriteria)->get();
            // $label = 'Penetapan';
            // break;
            case 'b':
                // Ambil dokumen berdasarkan kriteria_id
                $dokumen = DokumenPelaksanaanModel::where('kriteria_id', $kriteria->kriteria_id)->get();
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

        return view('dokumen._preview', compact('dokumen', 'label'));
    }
}
