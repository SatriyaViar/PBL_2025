<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    function index()
    {
        $breadcrumb = (object)[
            'title' => 'List of User',
            'list'  => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'User Akreditasi Polinema',
        ];

        $activeMenu = 'user';
        $level = LevelModel::all();

        return view('user.index', compact('breadcrumb', 'page', 'activeMenu', 'level'));
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'name', 'email', 'nidn', 'level_id')
            ->with('level');

        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                $btn  = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_name')->get();
        return view('user.create_ajax', compact('level'));
    }

    public function show_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_name')->get();
        return view('user.show_ajax', compact('user', 'level'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'name'     => 'required|string|max:100',
                'email'    => 'required|email|unique:m_user,email',
                'nidn'     => 'nullable|string|max:20',
                'password' => 'required|string|min:6',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $data = $request->all();
            $data['password'] = Hash::make($request->password);

            UserModel::create($data);

            return response()->json([
                'status'  => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    function edit_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_name')->get();
        return view('user.edit_ajax', compact('user', 'level'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|max:20|unique:m_user,username,' . $id . ',user_id',
                'name'     => 'required|string|max:100',
                'email'    => 'required|email|unique:m_user,email,' . $id . ',user_id',
                'nidn'     => 'nullable|string|max:20',
                'password' => 'nullable|string|min:6|max:20',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validasi gagal.',
                    'msgField'  => $validator->errors()
                ]);
            }

            $user = UserModel::find($id);
            if ($user) {
                $data = $request->all();

                if ($request->filled('password')) {
                    $data['password'] = Hash::make($request->password);
                } else {
                    unset($data['password']);
                }

                $user->update($data);

                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return redirect('/user');
    }

    public function confirm_ajax(string $id)
    {
        $user = UserModel::find($id);
        return view('user.confirm_ajax', compact('user'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);
            try {
                $deleted = UserModel::destroy($id);
                if ($deleted) {
                    return response()->json([
                        'status'  => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } else {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Gagal menghapus data user'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Error: ' . $e->getMessage()
                ]);
            }
        }
        redirect('/user');
    }
}
