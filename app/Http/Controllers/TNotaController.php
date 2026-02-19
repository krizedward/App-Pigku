<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TOrderDetail;
use App\Models\TOrder;
use App\Models\TMenu;
use Illuminate\Support\Facades\Auth;

class TNotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datas = TOrder::orderBy('created_at', 'desc')->get();
        return view('t_nota.t_nota', compact('datas'));
    }

    public function detail($id)
    {
        //
        $datas = TOrder::where('code_order', $id)->get();
        $order = TOrder::where('code_order', $id)->first();

        if (!$order) {
            abort(404, 'Order tidak ditemukan');
        }

        $hargaSubtotal = $order->total_price;
        $taxHarga = 0.0 * $hargaSubtotal;
        $hargaTotal = $hargaSubtotal + $taxHarga;
        $dataBaru = TOrderDetail::where('order_id', $order->id)->get();
        $hargaTotal = 'Rp. ' . number_format($hargaTotal, 0, ',', '.');
        // return $dataBaru;
        $menu = TMenu::all();
        $nota_id = $id;

        return view('t_nota.t_nota_detail', compact('datas','dataBaru','hargaSubtotal','taxHarga','hargaTotal','menu','nota_id'));
    }

    public function filter(Request $request)
    {
        $validated = $request->validate([
            'tanggal_awal'  => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
        ]);

        $datas = TOrder::query()
            ->when($validated['tanggal_awal'] ?? null, function ($query, $tanggalAwal) {
                $query->whereDate('date_order', '>=', $tanggalAwal);
            })
            ->when($validated['tanggal_akhir'] ?? null, function ($query, $tanggalAkhir) {
                $query->whereDate('date_order', '<=', $tanggalAkhir);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('t_nota.t_nota', compact('datas'));
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
        $request->validate([
            'nota_id' => 'required',
            'menu_id' => 'required',
            'qty_menu' => 'required|numeric',
            'note_order_detail' => 'required',
        ]);

        $menuIds = [1,5,6,7,8,9,10,18,19,20];
        $IdPertusuk = [3,4];
        $IdPerGelas = [2,11,12,13,14,15,16,17];

        // ambil order
        $order = TOrder::where('code_order', $id)->firstOrFail();

        // ambil menu
        $menu = TMenu::findOrFail($request->menu_id);

        $hargaMenuBaru = $menu->price_menu * $request->qty_menu;

        // update order
        $order->increment('total_item');
        $order->total_price += $hargaMenuBaru;
        $order->save();

        // user login
        $user = Auth::user()->name;

        if(in_array($menu->id, $menuIds)) {
            $type_additional = 'porsi';
        } elseif(in_array($menu->id, $IdPertusuk)) {
            $type_additional = 'tusuk';
        } elseif(in_array($menu->id, $IdPerGelas)) {
            $type_additional = 'gelas/botol';
        }

        // simpan detail order
        $order_detail = TOrderDetail::create([
            'order_id' => $order->id,
            'name_menu' => $menu->name_menu,
            'qty_order' => $request->qty_menu,
            'price_menu' => $menu->price_menu,
            'unit_menu' => $type_additional ?? '',
            'note_order_detail' => $request->note_order_detail,
            'create_by' => $user,
            'update_by' => $user,
        ]);

        return redirect()->route('nota.detail',['id' => $id])
            ->with('success', 'Data berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
