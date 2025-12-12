<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TPengguna;
use App\Models\MRole;
use App\Models\TRole;
use App\Models\User;

class TPenggunaController extends Controller
{
    protected $route = 't_pengguna';
    protected $data_validate = [
        'name_pengguna' => 'required|string|max:100',
        'email_pengguna' => 'required|email|unique:users,email',
        'jenis_pengguna' => 'required',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $data = TPengguna::all();
        $data = TRole::all();
        return view('t_pengguna.t_pengguna', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // MRole
        $data = MRole::all();
        return view('t_pengguna.t_pengguna_create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate($this->data_validate);
        
        // 2. Simpan data ke database
        $user = new User();
        $pengguna = new TPengguna();
        $role = new TRole();
        $role_name = MRole::findOrFail($validated['jenis_pengguna']);

        // Simpan ke users
        $user->name     = strtolower($role_name->name_role . '.' . $validated['name_pengguna']);
        $user->email    = $validated['email_pengguna'];
        $user->password = bcrypt('12345678');
        $user->save();

        // ===== Buat kode pengguna =====
        $tanggal = date('Ymdis');

        $kode_pengguna = "PGN-{$tanggal}";
        // ===============================

        // Simpan ke t_pengguna
        $pengguna->fullname_pengguna = $validated['name_pengguna'];
        $pengguna->username_pengguna = $validated['name_pengguna'];
        $pengguna->note_pengguna = '';
        $pengguna->user_id = $user->id;
        $pengguna->code_pengguna = $kode_pengguna;
        $pengguna->save();

        // Simpan role ke t_role
        $role->role_id      = $validated['jenis_pengguna']; // id dari m_role
        $role->pengguna_id  = $pengguna->id;
        $role->note_role    = '';
        $role->is_active    = 'Y';
        $role->save();

        // 3. Redirect
        return redirect()->route('pengguna.index')
                         ->with('success', 'Data pengguna berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // $data = MRole::findOrFail($id);
        $data = [];
        $dt_pengguna = TRole::findOrFail($id);
        return view($this->route.'.'.$this->route.'_edit', compact('data','dt_pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return 'edit';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return 'destroy';
    }
}
