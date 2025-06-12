<?php

namespace App\Http\Controllers;

use App\Models\DokumenPelaksanaanModel;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;
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

            // Validasi dasar
            $rules = [
                'description' => 'required|string',
            ];

            // Validasi jika ada file
            if ($request->hasFile('file_pendukung')) {
                $rules['file_pendukung'] = 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048';
            }

            // Validasi jika ada link
            if ($request->filled('link')) {
                $rules['link'] = 'url|max:255';
            }

            // Validasi jika dua-duanya kosong
            if (!$request->hasFile('file_pendukung') && !$request->filled('link')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Minimal salah satu dari file atau link harus diisi.',
                    'msgField' => [
                        'file_pendukung' => ['File atau link harus diisi.'],
                        'link' => ['File atau link harus diisi.'],
                    ]
                ], 422);
            }

            $validator = Validator::make($request->all(), $rules, [
                'description.required' => 'Deskripsi dokumen harus diisi',
                'file_pendukung.mimes' => 'Format file harus pdf, doc, docx, jpg, jpeg, atau png',
                'file_pendukung.max' => 'Ukuran file maksimal 2MB',
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
            if ($request->hasFile('file_pendukung')) {
                $file = $request->file('file_pendukung');
                $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('dokumen', $fileName, 'public');
            }

            // Simpan data
            DokumenPelaksanaanModel::create([
                'kriteria_id' => $kriteria->kriteria_id,
                'description' => $request->input('description'),
                'link' => $request->filled('link') ? $request->input('link') : null,
                'file_pendukung' => $filePath,
                'jenis_list' => $jenis_list,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Dokumen berhasil disimpan',
                'redirect' => route('ppep.index', ['id' => $kriteria->kriteria_id])
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

        return view('dokumen._preview', compact('dokumen', 'label', 'jenis_list'));
    }

    public function edit($kriteria_nama, $jenis_list, $id)
    {
        $dokumen = DokumenPelaksanaanModel::findOrFail($id);
        return view('dokumen.edit', compact('dokumen', 'kriteria_nama', 'jenis_list'));
    }

    public function update(Request $request, $kriteria, $jenis_list, $id)
    {
        $dokumen = DokumenPelaksanaanModel::findOrFail($id);

        $request->validate([
            'description' => 'required',
            'file_pendukung' => 'nullable|file|mimes:pdf,docx,doc,xls,xlsx,png,jpg,jpeg',
            'link' => 'nullable|url'
        ]);

        $dokumen->description = $request->description;

        if ($request->hasFile('file_pendukung')) {
            $file = $request->file('file_pendukung')->store('dokumen', 'public');
            $dokumen->file_pendukung = $file;
        }

        $dokumen->link = $request->link;
        $dokumen->save();

        return redirect()->route('dokumen.index', [$kriteria, $jenis_list])->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy($kriteria, $jenis_list, $id)
    {
        try {
            $dokumen = DokumenPelaksanaanModel::findOrFail($id);
            if ($dokumen->file_pendukung) {
                Storage::disk('public')->delete($dokumen->file_pendukung);
            }

            $dokumen->delete();

            return response()->json(['success' => true , 'message' => 'Dokumen berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus dokumen.'], 500);
        }
    }
}
