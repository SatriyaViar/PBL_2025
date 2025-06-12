<?php

namespace App\Http\Controllers;

use App\Models\ResearchModel;
use App\Models\LecturerResearchModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PenelitianDosenController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user = auth()->user()->user_id;

                $data = LecturerResearchModel::with('dosen', 'penelitian')
                    ->where('user_id', $user)
                    ->select('id_penelitian_dosen', 'id_penelitian', 'id_dosen', 'status');

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $id = $row->id_penelitian_dosen;
                        $btn = '
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-info" title="Detail"
                                onclick="modalAction(\'' . url("penelitian-dosen/dosen/" . $id) . '\')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" title="Edit"
                                onclick="modalAction(\'' . url("penelitian-dosen/dosen/" . $id . "/edit") . '\')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" title="Hapus"
                                onclick="deletePenelitian(' . $id . ')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error("Error DataTables Penelitian Dosen: " . $e->getMessage());
                return response()->json(['message' => 'Terjadi kesalahan pada server.'], 500);
            }
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Penelitian Dosen',
            'list' => ['Home', 'Penelitian Dosen']
        ];

        $page = (object)[
            'title' => 'Daftar penelitian dosen yang terdaftar dalam sistem'
        ];

        return view('penelitian-dosen.dosen.index', compact('breadcrumb', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penelitian-dosen.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Store function called with data:', $request->all());

        if (!$request->ajax() && !$request->wantsJson()) {
            return redirect('/dashboard'); // ← jangan lupa pakai `return`
        }

        $validator = Validator::make($request->all(), [
            'no_surat_tugas' => 'required',
            'judul_penelitian' => 'required',
            'pendanaan_internal' => 'nullable',
            'pendanaan_eksternal' => 'nullable',
            'link_penelitian' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            // Simpan data penelitian
            $penelitian = ResearchModel::create([
                'no_surat_tugas' => $request->no_surat_tugas,
                'judul_penelitian' => $request->judul_penelitian,
                'pendanaan_internal' => $request->pendanaan_internal,
                'pendanaan_eksternal' => $request->pendanaan_eksternal,
                'link_penelitian' => $request->link_penelitian
            ]);

            // Ambil dosen ID dari user yang login
            $dosenId = auth()->user()->user_id ?? null;
            // dd($dosenId);

            if (!$dosenId) {
                return response()->json([
                    'message' => 'Gagal mengambil data dosen dari user yang login'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            // Simpan relasi dosen ke penelitian
            LecturerResearchModel::create([
                'user_id' => $dosenId,
                'penelitian_id' => $penelitian->id_penelitian,
                'status' => 'accepted'
            ]);

            Log::info('Penelitian created: ', $penelitian->toArray());

            return response()->json([
                'message' => 'Penelitian berhasil disimpan'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error("Gagal menyimpan penelitian: " . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data LecturerResearchModel berdasarkan id
        $penelitianDosen = LecturerResearchModel::with('penelitian', 'dosen') // Dengan relasi
            ->where('id_penelitian_dosen', $id) // Mengambil berdasarkan penelitian_id
            ->firstOrFail(); // Gunakan get() untuk mengambil lebih dari satu data dosen terkait dengan penelitian ini

        // Kirim data penelitian dan dosen ke view
        return view('penelitian-dosen.dosen.show', compact('penelitianDosen'));
    }

    public function statusPenelitian(Request $request, $id)
    {
        $penelitianDosen = LecturerResearchModel::with('penelitian', 'dosen') // Dengan relasi
            ->where('id_penelitian_dosen', $id) // Mengambil berdasarkan penelitian_id
            ->first();

        if (!$penelitianDosen) {
            return response()->json([
                'message' => 'Data penelitian dosen tidak ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        //update status
        $penelitianDosen->status = $request->status;
        $penelitianDosen->save();

        return response()->json([
            'message' => 'Status penelitian dosen berhasil diubah.'
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penelitianDosen = LecturerResearchModel::with('penelitian') // Dengan relasi
            ->where('id_penelitian_dosen', $id) // Mengambil berdasarkan penelitian_id
            ->firstOrFail();
        return view('penelitian-dosen.dosen.edit', compact('penelitianDosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang dikirimkan
        $validator = Validator::make($request->all(), [
            'no_surat_tugas' => 'required',
            'judul_penelitian' => 'required',
            'pendanaan_internal' => 'nullable',
            'pendanaan_eksternal' => 'nullable',
            'status' => 'required|in:accepted,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        // Cari data t_penelitian_dosen berdasarkan id
        $penelitianDosen = LecturerResearchModel::findOrFail($id);

        if (!$penelitianDosen) {
            return response()->json([
                'message' => 'Data penelitian dosen tidak ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        // if ($penelitianDosen->status == 'accepted') {
        //     return response()->json([
        //         'message' => 'Penelitian Sudah di Setujui oleh Dosen tidak bisa update'
        //     ], Response::HTTP_BAD_REQUEST);
        // }

        // if ($penelitianDosen->status == 'rejected') {
        //     return response()->json([
        //         'message' => 'Penelitian Sudah di Tolak oleh Dosen tidak bisa update'
        //     ], Response::HTTP_BAD_REQUEST);
        // }

        // Cari data penelitian terkait
        $penelitian = $penelitianDosen->penelitian;

        // Update data penelitian jika perlu
        $penelitian->update([
            'no_surat_tugas' => $request->no_surat_tugas ?? $penelitian->no_surat_tugas,
            'judul_penelitian' => $request->judul_penelitian ?? $penelitian->judul_penelitian,
            'pendanaan_internal' => $request->pendanaan_internal ?? $penelitian->pendanaan_internal,
            'pendanaan_eksternal' => $request->pendanaan_eksternal ?? $penelitian->pendanaan_eksternal,
        ]);


        // Update status penelitian
        $penelitianDosen->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Data penelitian dan dosen berhasil diupdate'
        ], Response::HTTP_OK);
    }

    public function confirm(string $id)
    {
        $penelitianDosen = LecturerResearchModel::find($id);
        return view('penelitian-dosen.dosen.confirm-delete', compact('penelitianDosen'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penelitianDosen = LecturerResearchModel::find($id);
            // dd($penelitianDosen);
            if (!$penelitianDosen) {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            // if ($penelitianDosen->status == 'accepted') {
            //     return response()->json([
            //         'message' => 'Penelitian Sudah di Setujui oleh Dosen tidak bisa dihapus'
            //     ], Response::HTTP_BAD_REQUEST);
            // }

            // if ($penelitianDosen->status == 'rejected') {
            //     return response()->json([
            //         'message' => 'Penelitian Sudah di Tolak oleh Dosen tidak bisa dihapus'
            //     ], Response::HTTP_BAD_REQUEST);
            // }

            try {
                $penelitianDosen->delete();

                Log::info("LecturerResearchModel ID $id berhasil dihapus.");

                return response()->json([
                    'message' => 'Data berhasil dihapus!'
                ], Response::HTTP_OK);
            } catch (\Exception $e) {
                Log::error("Gagal menghapus LecturerResearchModel ID $id: " . $e->getMessage());

                return response()->json([
                    'message' => 'Terjadi kesalahan saat menghapus data.'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return redirect('/dashboard');
    }
}
