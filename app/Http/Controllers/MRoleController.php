<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MPayment;
use App\Models\MRole;
use Illuminate\Support\Facades\Auth;

class MRoleController extends Controller
{
    protected $route = 'm_role';
    protected $data_validate = [
        'name_role' => 'required|string|max:255',
        'note_role' => 'nullable|string',
        'create_by' => 'nullable|string',
        'update_by' => 'nullable|string',
        'is_active' => 'required|in:Y,N',
    ];
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datas = MRole::all();
        return view($this->route.'.'.$this->route, compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view($this->route.'.'.$this->route.'_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate($this->data_validate);
        MRole::create($validated);
        
        return redirect()->route('master-role.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = MRole::findOrFail($id);
        return view($this->route.'.'.$this->route.'_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate($this->data_validate);

        $data = MRole::findOrFail($id);
        
        // foreach (array_keys($this->data_validate) as $field) {
        //     // Jika field nullable dan tidak ada di $validated, isi dengan null
        //     $data->{$field} = $validated[$field] ?? null;
        // }

        foreach ($validated as $field => $value) {
            $data->{$field} = $value;
        }

        $data->update_by = Auth::user()->name;
        $data->save();

        return redirect()->route('master-role.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = MRole::find($id);
        $id->delete();
        return redirect()->route('master-role.index')->with('success', 'Data berhasil dihapus.');
    }
}
