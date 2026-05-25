<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MBarang;
use App\Models\MSatuan;

class MBarangController extends Controller
{
    protected $data_validate = [
        'name_barang' => 'required|string|max:255',
        'satuan_id' => 'required|string|max:255',
        'brand_barang' => 'nullable|string',
        'volume_barang' => 'nullable|string',
        'note_barang' => 'nullable|string',
        'is_active' => 'required|in:Y,N',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // MBarang
        $datas = MBarang::orderBy('id', 'desc')->get();
        return view('m_barang.m_barang', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $satuan = MSatuan::all();
        return view('m_barang.m_barang_create', compact('satuan'));
        // return view('m_barang.m_barang_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->data_validate);
        MBarang::create($validated);
        
        return redirect()->route('master-barang.index')->with('success', 'Data berhasil ditambahkan.');
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
        $satuan = MSatuan::all();
        $data = MBarang::findOrFail($id);
        return view('m_barang.m_barang_edit', compact('satuan','data'));
        // return 'edit form';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate($this->data_validate);
        $data = MBarang::findOrFail($id);

        foreach ($validated as $field => $value) {
            $data->{$field} = $value;
        }

        // $data->update_by = Auth::user()->name;
        $data->save();

        return redirect()->route('master-barang.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = MBarang::find($id);
        $id->delete();
        return redirect()->route('master-barang.index')->with('success', 'Data berhasil dihapus.');
    }
}
