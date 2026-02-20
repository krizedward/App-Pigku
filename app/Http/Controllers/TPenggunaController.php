<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TPengguna;
use App\Models\MRole;
use App\Models\TRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TPenggunaController extends Controller
{
    protected $route = 't_pengguna';
    protected $data_validate = [
        'name_pengguna' => 'required|string|max:100',
        'email_pengguna' => 'required|email',
        'username_pengguna' => 'required',
        'jenis_pengguna' => 'required',
        'note_pengguna' => 'required',
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
        try {
            // 1. Validasi input
            $validated = $request->validate($this->data_validate);
            
            // 2. Simpan data ke database
            $user = new User();
            $pengguna = new TPengguna();
            $role = new TRole();
            $role_name = MRole::findOrFail($validated['jenis_pengguna']);

            // Simpan ke users
            $user->name     = strtolower($role_name->name_role . '.' . $validated['username_pengguna']);
            $user->email    = $validated['email_pengguna'];
            $user->password = bcrypt('12345678');
            $user->save();

            // ===== Buat kode pengguna =====
            $tanggal = date('Ymdis');

            $kode_pengguna = "PGN-{$tanggal}";
            // ===============================

            // Simpan ke t_pengguna
            $pengguna->fullname_pengguna = $validated['name_pengguna'];
            $pengguna->username_pengguna = $validated['username_pengguna'];
            $pengguna->note_pengguna = $validated['note_pengguna'];
            $pengguna->user_id = $user->id;
            $pengguna->code_pengguna = $kode_pengguna;
            $pengguna->create_by = Auth::user()->name;
            $pengguna->update_by = Auth::user()->name;
            $pengguna->save();

            // Simpan role ke t_role
            $role->role_id      = $validated['jenis_pengguna']; // id dari m_role
            $role->pengguna_id  = $pengguna->id;
            $role->note_role    = '';
            $role->is_active    = 'Y';
            $role->create_by    = Auth::user()->name;
            $role->update_by    = Auth::user()->name;
            $role->save();

            // 3. Redirect
            return redirect()->route('pengguna.index')
                ->with('success', 'Data pengguna berhasil ditambahkan');
            
        } catch (\Exception $e) {
            
            return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
        }
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
        $data = MRole::all();
        $dt_pengguna = TRole::findOrFail($id);
        return view($this->route.'.'.$this->route.'_edit', compact('data','dt_pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // DB::beginTransaction();
        try {
            $validated = $request->validate($this->data_validate);
            
            // ambil data utama
            $role = TRole::findOrFail($id);
            $pengguna = TPengguna::findOrFail($role->pengguna_id);

            $user = User::findOrFail($pengguna->user_id);
            // $user = User::findOrFail($pengguna->user_id);

            $role_name = MRole::findOrFail($validated['jenis_pengguna']);

            // update user
            $user->name  = strtolower($role_name->name_role . '.' . $validated['username_pengguna']);
            // $user->email = $validated['email_pengguna'];
            $user->save();

            // update pengguna
            $pengguna->fullname_pengguna = $validated['name_pengguna'];
            $pengguna->username_pengguna = $validated['username_pengguna'];
            $pengguna->note_pengguna = $validated['note_pengguna'];
            $pengguna->update_by = Auth::user()->name;
            $pengguna->save();

            // update role
            $role->role_id = $validated['jenis_pengguna'];
            $role->update_by    = Auth::user()->name;
            $role->save();

            // DB::commit();

            return redirect()->route('pengguna.index')
                ->with('success', 'Data pengguna berhasil diperbarui');

        } catch (\Exception $e) {

            // DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $role = TRole::findOrFail($id);

            $pengguna = TPengguna::findOrFail($role->pengguna_id);

            $user = User::findOrFail($pengguna->user_id);

            // hapus berurutan
            $role->delete();
            $pengguna->delete();
            $user->delete();

            return redirect()->route('pengguna.index')
                ->with('success', 'Data pengguna berhasil dihapus');

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}
