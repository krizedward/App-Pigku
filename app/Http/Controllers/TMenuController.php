<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TMenu;
use App\Models\TMenuPaket;
use App\Models\MKategori;
use App\Models\TTempmenudetail;

class TMenuController extends Controller
{
    protected $data_validate = [
        'name_menu' => 'required|string|max:255',
        'kategori_id' => 'nullable',
        'price_menu' => 'nullable',
        'note_menu' => 'nullable|string',
        'is_active' => 'required|in:Y,N',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datas = TMenu::all();
        $paket = TMenuPaket::all();
        return view('t_menu.t_menu', compact('datas','paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // ambil semua id menu yang sudah ada di paket
        $paketIds = TMenuPaket::pluck('menu_id'); // sesuaikan nama kolom foreign key

        // ambil menu yang id-nya belum ada di paket
        $menu = TMenu::whereNotIn('id', $paketIds)->get();
        $paket = TMenuPaket::all();
        $kategori = MKategori::where('main_kategori', 'Menu')->get();
        $temp_menudetail = TTempmenudetail::all();
        return view('t_menu.t_menu_create', compact('kategori','paket','menu','temp_menudetail'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->data_validate);
        TMenu::create($validated);

        return redirect()->route('menu.index')->with('success', 'Data berhasil ditambahkan.');
        //
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
    public function edit($id)
    {
        //
        // Ambil data menu berdasarkan ID
        $menu = TMenu::findOrFail($id);

        // Ambil semua kategori
        $kategori = MKategori::all();

        // Kirim ke view
        return view('t_menu.t_menu_edit', compact('menu', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate($this->data_validate);

        // Ambil data menu berdasarkan ID
        $menu = TMenu::findOrFail($id);

        // Update dengan data baru
        $menu->update($validated);

        // Redirect dengan pesan sukses
        return redirect()
            ->route('menu.index')
            ->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $id = TMenu::find($id);
        $id->delete();
        return redirect()->route('menu.index')->with('success', 'Data berhasil dihapus.');
    }

    public function store_paket(Request $request)
    {
        $validated = $request->validate($this->data_validate);
        TMenu::create($validated);

        return redirect()->route('menu.index')->with('success', 'Data berhasil ditambahkan.');
        //
    }
}
