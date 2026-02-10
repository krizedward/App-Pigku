<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TMenu;
use App\Models\TTemporder;
use Illuminate\Support\Facades\Auth;

class TTemporderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'menu_id'     => 'required|exists:t_menu,id',
            'date_order'  => 'required|date',
            'qty_menu'   => 'required|integer|min:1',
        ]);

        // Ambil data menu untuk hitung total harga
        $menu = TMenu::findOrFail($validated['menu_id']);
        $totalPrice = $menu->price_menu * $validated['qty_menu'];
        $user = Auth::user()->name;

        // Simpan order baru
        TTemporder::create([
            'menu_id'    => $validated['menu_id'],
            'date_order' => $validated['date_order'],
            // 'name_menu'  => $menu->name_menu,
            // 'price_menu' => $menu->price_menu,
            'qty_menu'   => $validated['qty_menu'],
            'subtotal_price' => $totalPrice,
            'create_by'   => $user,
        ]);
        // Arahkan ke halaman sesuai dengan type_form
        if ($request->type_form === 'list_form') {
            return redirect()
                ->back()
                ->with('success', 'Order berhasil ditambahkan!');
        } elseif ($request->type_form === 'kasir') {
            return redirect()
                ->back()
                ->with('success', 'Order berhasil ditambahkan!');
        } else {
            return redirect()
                ->route('order.create')
                ->with('success', 'Order berhasil ditambahkan!');
        }
    }

    public function destroy($id)
    {
        //
        $id = TTemporder::find($id);
        $id->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function reset(Request $request)
    {
        TTemporder::truncate();

        if ($request->type_form === 'list_form') {
            return redirect()
                ->route('t_order.list', ['date' => $tanggal])
                ->with('success', 'Order berhasil ditambahkan!');
        } else {
            return redirect()->route('cashier.index')
            ->with('success', 'Semua data berhasil dihapus!');
        }
    }
}
