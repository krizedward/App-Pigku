<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BRoleMenu;
use App\Models\BMenu;
use App\Models\TRole;
use Illuminate\Support\Facades\Auth;

class BRoleMenuController extends Controller
{
    protected $data_validate = [
        'trole_id' => 'required|integer|exists:t_role,id',
        'bmenu_id' => 'required|integer|exists:b_menu,id',
        'note_b_role_menu' => 'nullable|string',
        'is_active' => 'nullable|in:Y,N',
        'create_by' => 'nullable|string|max:255',
        'update_by' => 'nullable',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datas = TRole::all();
        return view('b_role_menu.b_role_menu', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $menus = BMenu::all();
        $roles = TRole::all();
        return view('b_role_menu.b_role_menu_create',compact('menus','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate($this->data_validate);
        // BRoleMenu::create($validated);
        // Tambahkan info user yang sedang login
        $validated['create_by'] = Auth::user()->name ?? 'system';
        $validated['update_by'] = Auth::user()->name ?? 'system';

        // Simpan data
        BRoleMenu::create($validated);
        return redirect()->route('akses.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function detail(string $id)
    {
        //
        $menus = BMenu::all();
        // akses menu untuk role tertentu
        $roleMenus = BRoleMenu::where('trole_id', $id)
            ->pluck('is_active', 'bmenu_id')
            ->toArray();
        
        return view('b_role_menu.b_role_menu_detail',compact('menus', 'roleMenus', 'id'));
        // return view('b_role_menu.b_role_menu_detail');
        // return 'coming soon';
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
        //
        return 'hapus b_role_menu';
    }

    public function toggle($role_id, $menu_id)
    {
        $item = BRoleMenu::firstOrCreate(
            ['trole_id' => $role_id, 'bmenu_id' => $menu_id],
            ['is_active' => 'N']
        );

        $item->is_active = $item->is_active === 'Y' ? 'N' : 'Y';
        $item->save();

        return back();
    }


}
