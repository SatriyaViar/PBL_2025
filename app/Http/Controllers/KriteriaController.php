<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KriteriaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Kriteria Akreditasi',
            'list'  => ['Home', 'Kriteria']
        ];

        $page = (object)[
            'title' => 'Kriteria Akreditasi'
        ];

        $activeMenu = 'kriteria';
        $kriteria = KriteriaModel::all();
        $user = UserModel::all();

        return view('kriteria.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'user'   => $user,

        ]);
    }

    public function getSidebarKriteria()
    {
        $kriteria = KriteriaModel::all(['kriteria_id', 'kriteria_nama']);

        return response()->json($kriteria);
    }


    public function list()
    {
        $kriteria = KriteriaModel::select('kriteria_id', 'kriteria_nama', 'kriteria_link');

        return DataTables::of($kriteria)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('action', function ($kriteria) { // menambahkan kolom action
                //AJAX
                $btn = '<button onclick="modalAction(\'' . url('/kriteria/' . $kriteria->kriteria_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kriteria/' . $kriteria->kriteria_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kriteria/' . $kriteria->kriteria_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['action']) // memberitahu bahwa kolom action adalah html
            ->make(true);
    }

    function create_ajax()
    {
        return view('kriteria.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kriteria_nama' => 'required|string|max:100',
                'kriteria_link' => 'required|string|max:100',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal', // pesan error validasi
                    'msgField' => $validator->errors(),
                ]);
            }

            KriteriaModel::create([
                'user_id' => 2, // sementara isi manual (atau ganti sesuai user aktif)
                'kriteria_nama' => $request->kriteria_nama,
                'kriteria_link' => $request->kriteria_link,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data Kriteria berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    function edit_ajax(string $id)
    {
        $kriteria = KriteriaModel::find($id);
        return view('kriteria.edit_ajax', ['kriteria' => $kriteria]);
    }

    public function update_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari AJAX
        if ($request->ajax()) {
            // Validasi input
            $rules = [
                'kriteria_nama' => 'required|string|max:100',
                'kriteria_link' => 'required|string|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validasi gagal.',
                    'msgField'  => $validator->errors()
                ]);
            }

            // Cek apakah user ditemukan
            $kriteria = KriteriaModel::find($id);
            if ($kriteria) {

                // Update data kriter$kriteria
                $kriteria->update([
                    'user_id' => 2, // sementara isi manual (atau ganti sesuai user aktif)
                    'kriteria_nama' => $request->kriteria_nama,
                    'kriteria_link' => $request->kriteria_link,
                ]);

                return response()->json([
                    'status'    => true,
                    'message'   => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Data tidak ditemukan'
                ]);
            }
        }

        // Jika bukan request AJAX
        return redirect('/kriteria');
    }

    public function show_ajax(String $id)
    {
        $kriteria = KriteriaModel::find($id);

        return view('kriteria.show_ajax', compact('kriteria'));
    }

    public function confirm_ajax(string $id)
    {
        $kriteria = KriteriaModel::find($id);
        return view('kriteria.confirm_ajax', ['kriteria' => $kriteria]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kriteria = KriteriaModel::find($id);
            if ($kriteria) {
                try {
                    KriteriaModel::destroy($id);
                    return response()->json([
                        'status'  => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'
                    ]);
                }
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        redirect('/');
    }
}
