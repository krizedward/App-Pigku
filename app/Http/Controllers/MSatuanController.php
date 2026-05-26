<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MSatuan;

class MSatuanController extends Controller
{
    protected $data_validate = [
        'name_satuan' => 'required|string|max:255',
        'symbol_satuan' => 'nullable|string',
        'note_satuan' => 'nullable|string',
        'is_active' => 'required|in:Y,N',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // MBarang
        $datas = MSatuan::all();
        return view('m_satuan.m_satuan', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('m_satuan.m_satuan_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate($this->data_validate);
        MSatuan::create($validated);
        
        return redirect()->route('master-satuan.index')->with('success', 'Data berhasil ditambahkan.');
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
        $data = MSatuan::findOrFail($id);
        return view('m_satuan.m_satuan_edit', compact('data'));
        // return 'edit form';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate($this->data_validate);
        $data = MSatuan::findOrFail($id);

        foreach ($validated as $field => $value) {
            $data->{$field} = $value;
        }

        // $data->update_by = Auth::user()->name;
        $data->save();

        return redirect()->route('master-satuan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = MSatuan::find($id);
        $id->delete();
        return redirect()->route('master-satuan.index')->with('success', 'Data berhasil dihapus.');
    }
}
