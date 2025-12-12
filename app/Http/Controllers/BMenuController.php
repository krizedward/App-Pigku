<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BRoleMenu;
use App\Models\BMenu;
use App\Models\TRole;
use Illuminate\Support\Facades\Auth;

class BMenuController extends Controller
{
    protected $data_validate = [
        'menu_code' => 'nullable',
        'menu_category_code' => 'nullable',
        'menu_name' => 'nullable',
        'menu_host' => 'nullable',
        'update_url' => 'nullable',
        'menu_order' => 'nullable',
        'menu_type' => 'nullable',
        'is_active' => 'nullable|in:Y,N',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datas = BMenu::all();
        return view('b_menu.b_menu', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    }

    public function toggle($id)
    {
        $data = BMenu::findOrFail($id);
        $data->is_active = ($data->is_active === 'Y') ? 'N' : 'Y';
        $data->save();

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }
}
