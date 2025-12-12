<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MKategori;

class MKategoriController extends Controller
{
    protected $data_validate = [
        'name_kategori' => 'required|string|max:255',
        'note_kategori' => 'nullable|string',
        'is_active' => 'required|in:Y,N',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $datas = MKategori::orderBy('updated_at', $sortOrder)->paginate($perPage);
        $datas = MKategori::all();
        return view('m_kategori.m_kategori', compact('datas'));
        // return view('templates.'.$this->route.'.'.$this->route, compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('m_kategori.m_kategori_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->data_validate);
        MKategori::create($validated);
        
        return redirect()->route('master-kategori.index')->with('success', 'Data berhasil ditambahkan.');
        //
        // return 
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = MKategori::find($id);
        $id->delete();
        return redirect()->route('master-kategori.index')->with('success', 'Data berhasil dihapus.');
    }
}
