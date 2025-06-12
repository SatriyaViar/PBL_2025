<?php

namespace App\Http\Controllers;

use App\Models\DokuemnPengendalianiModel;
use App\Models\DokumenEvaluasiModel;
use App\Models\DokumenPelaksanaanModel;
use App\Models\DokumenPenetapan;
use App\Models\DokumenPengendalianiModel;
use App\Models\DokumenPeningkatanModel;
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
            case 'a':
                $dokumen = DokumenPenetapan::where('kriteria_id', $kriteria_nama)->get();
                $label = 'Penetapan';
                break;
            case 'b':
                $dokumen = DokumenPelaksanaanModel::where('kriteria_id', $kriteria_nama)->get();
                $label = 'Pelaksanaan';
                break;
            case 'c':
                $dokumen = DokumenEvaluasiModel::where('kriteria_id', $kriteria_nama)->get();
                $label = 'Evaluasi';
                break;
            case 'd':
                $dokumen = DokumenPengendalianiModel::where('kriteria_id', $kriteria_nama)->get();
                $label = 'Pengendalian';
                break;
            case 'e':
                $dokumen = DokumenPeningkatanModel::where('kriteria_id', $kriteria_nama)->get();
                $label = 'Peningkatan';
                break;
            default:
                abort(404, 'Jenis dokumen tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Dokumen Kriteria',
            'list'  => ['Home', $kriteria_nama, $label],
        ];

        $activeMenu = 'Dokumen Akreditasi';
        return view('dokumen.index', compact('breadcrumb', 'kriteria_nama', 'activeMenu', 'dokumen', 'label', 'jenis_list'));
    }



    public function list($kriteria_nama, $jenis_list)
    {
        switch (strtolower($jenis_list)) {
            case 'a':
                $dokumen = DokumenPenetapan::where('kriteria_id', $kriteria_nama)->get();
                break;
            case 'b':
                $dokumen = DokumenPelaksanaanModel::where('kriteria_id', $kriteria_nama)->get();
                break;
            case 'c':
                $dokumen = DokumenEvaluasiModel::where('kriteria_id', $kriteria_nama)->get();
                break;
            case 'd':
                $dokumen = DokumenPengendalianiModel::where('kriteria_id', $kriteria_nama)->get();
                break;
            case 'e':
                $dokumen = DokumenPeningkatanModel::where('kriteria_id', $kriteria_nama)->get();
                break;
            default:
                abort(404, 'Jenis dokumen tidak ditemukan');
        };
        // Map file URL jika ada
        $dokumen->map(function ($item) {
            $item->file_url = $item->file_pendukung ? asset('storage/' . $item->file_pendukung) : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'data' => $dokumen
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

            // Simpan data sesuai dengan jenis dokumen
            switch (strtolower($jenis_list)) {
                case 'a':
                    DokumenPenetapan::create([
                        'kriteria_id' => $kriteria->kriteria_id,
                        'description' => $request->input('description'),
                        'link' => $request->filled('link') ? $request->input('link') : null,
                        'file_pendukung' => $filePath,
                        'jenis_list' => $jenis_list,
                    ]);
                    break;
                case 'b':
                    DokumenPelaksanaanModel::create([
                        'kriteria_id' => $kriteria->kriteria_id,
                        'description' => $request->input('description'),
                        'link' => $request->filled('link') ? $request->input('link') : null,
                        'file_pendukung' => $filePath,
                        'jenis_list' => $jenis_list,
                    ]);
                    break;
                case 'c':
                    DokumenEvaluasiModel::create([
                        'kriteria_id' => $kriteria->kriteria_id,
                        'description' => $request->input('description'),
                        'link' => $request->filled('link') ? $request->input('link') : null,
                        'file_pendukung' => $filePath,
                        'jenis_list' => $jenis_list,
                    ]);
                    break;
                case 'd':
                    DokumenPengendalianiModel::create([
                        'kriteria_id' => $kriteria->kriteria_id,
                        'description' => $request->input('description'),
                        'link' => $request->filled('link') ? $request->input('link') : null,
                        'file_pendukung' => $filePath,
                        'jenis_list' => $jenis_list,
                    ]);
                    break;
                case 'e':
                    DokumenPeningkatanModel::create([
                        'kriteria_id' => $kriteria->kriteria_id,
                        'description' => $request->input('description'),
                        'link' => $request->filled('link') ? $request->input('link') : null,
                        'file_pendukung' => $filePath,
                        'jenis_list' => $jenis_list,
                    ]);
                    break;
                default:
                    return response()->json([
                        'status' => false,
                        'message' => 'Jenis dokumen tidak valid.',
                    ], 404);
            }

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

        // Menentukan jenis dokumen berdasarkan $jenis_list
        switch (strtolower($jenis_list)) {
            case 'a':
                $dokumen = DokumenPenetapan::where('kriteria_id', $kriteria->kriteria_id)->get();
                $label = 'Penetapan';
                break;
            case 'b':
                $dokumen = DokumenPelaksanaanModel::where('kriteria_id', $kriteria->kriteria_id)->get();
                $label = 'Pelaksanaan';
                break;
            case 'c':
                $dokumen = DokumenEvaluasiModel::where('kriteria_id', $kriteria->kriteria_id)->get();
                $label = 'Evaluasi';
                break;
            case 'd':
                $dokumen = DokumenPengendalianiModel::where('kriteria_id', $kriteria->kriteria_id)->get();
                $label = 'Pengendalian';
                break;
            case 'e':
                $dokumen = DokumenPeningkatanModel::where('kriteria_id', $kriteria->kriteria_id)->get();
                $label = 'Peningkatan';
                break;
            default:
                abort(404, 'Jenis dokumen tidak ditemukan');
        }

        // Mengembalikan view dengan data dokumen yang sesuai
        return view('dokumen._preview', compact('dokumen', 'label', 'jenis_list'));
    }

    public function destroy($kriteria_nama, $jenis_list, $id)
    {
        try {
            // Validasi kriteria
            $kriteria = KriteriaModel::where('kriteria_nama', $kriteria_nama)->first();
            if (!$kriteria) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kriteria tidak ditemukan.'
                ], 404);
            }

            // Ambil dokumen berdasarkan ID dan jenis dokumen
            switch (strtolower($jenis_list)) {
                case 'a':
                    $dokumen = DokumenPenetapan::findOrFail($id);
                    break;
                case 'b':
                    $dokumen = DokumenPelaksanaanModel::find($id);
                    break;
                case 'c':
                    $dokumen = DokumenEvaluasiModel::find($id);
                    break;
                case 'd':
                    $dokumen = DokumenPengendalianiModel::find($id);
                    break;
                case 'e':
                    $dokumen = DokumenPeningkatanModel::find($id);
                    break;
                default:
                    return response()->json([
                        'status' => false,
                        'message' => 'Jenis dokumen tidak valid.'
                    ], 404);
            }

            if (!$dokumen) {
                return response()->json([
                    'status' => false,
                    'message' => 'Dokumen tidak ditemukan.'
                ], 404);
            }

            // Hapus file jika ada
            if ($dokumen->file_pendukung && Storage::exists('public/' . $dokumen->file_pendukung)) {
                Storage::delete('public/' . $dokumen->file_pendukung);
            }

            // Hapus dokumen
            $dokumen->delete();

            return response()->json([
                'status' => true,
                'message' => 'Dokumen berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in DokumenController@delete: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($kriteria_nama, $jenis_list, $id)
    {
        $kriteria = KriteriaModel::where('kriteria_nama', $kriteria_nama)->first();
        if (!$kriteria) {
            return redirect()->back()->with('error', 'Kriteria tidak ditemukan.');
        }

        switch (strtolower($jenis_list)) {
            case 'a':
                $dokumen = DokumenPenetapan::findOrFail($id);
                $label = 'Penetapan';
                break;
            case 'b':
                $dokumen = DokumenPelaksanaanModel::findOrFail($id);
                $label = 'Pelaksanaan';
                break;
            case 'c':
                $dokumen = DokumenEvaluasiModel::findOrFail($id);
                $label = 'Evaluasi';
                break;
            case 'd':
                $dokumen = DokumenPengendalianiModel::findOrFail($id);
                $label = 'Pengendalian';
                break;
            case 'e':
                $dokumen = DokumenPeningkatanModel::findOrFail($id);
                $label = 'Peningkatan';
                break;
            default:
                return redirect()->back()->with('error', 'Jenis dokumen tidak valid.');
        }

        return view('dokumen.edit', compact('dokumen', 'kriteria', 'jenis_list', 'label', 'kriteria_nama'));
    }

    public function update(Request $request, $kriteria_nama, $jenis_list, $id)
    {
        $kriteria_nama = KriteriaModel::where('kriteria_nama', $kriteria_nama)->firstOrFail();

        switch (strtolower($jenis_list)) {
            case 'a':
                $dokumen = DokumenPenetapan::findOrFail($id);
                break;
            case 'b':
                $dokumen = DokumenPelaksanaanModel::findOrFail($id);
                break;
            case 'c':
                $dokumen = DokumenEvaluasiModel::findOrFail($id);
                break;
            case 'd':
                $dokumen = DokumenPengendalianiModel::findOrFail($id);
                break;
            case 'e':
                $dokumen = DokumenPeningkatanModel::findOrFail($id);
                break;
            default:
                return redirect()->back()->with('error', 'Jenis dokumen tidak valid.');
        }

        $request->validate([
            'description' => 'required|string',
            'link' => 'nullable|url',
            'file_pendukung' => 'nullable|mimes:pdf|max:2048',
        ]);

        $dokumen->description = $request->description;
        $dokumen->link = $request->link;

        if ($request->hasFile('file_pendukung')) {
            // Hapus file lama
            if ($dokumen->file_pendukung && Storage::exists('public/' . $dokumen->file_pendukung)) {
                Storage::delete('public/' . $dokumen->file_pendukung);
            }

            $path = $request->file('file_pendukung')->store('dokumen', 'public');
            $dokumen->file_pendukung = $path;
        }

        $dokumen->save();

        return redirect()->route('dokumen.preview', [$kriteria_nama, $jenis_list])
            ->with('success', 'Dokumen berhasil diperbarui.');
    }
}
