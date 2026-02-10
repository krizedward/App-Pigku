<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TOrderDetail;
use App\Models\TOrder;

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
        $taxHarga = 0.10 * $hargaSubtotal;
        $hargaTotal = $hargaSubtotal + $taxHarga;
        $dataBaru = TOrderDetail::where('order_id', $order->id)->get();
        // return $dataBaru;

        return view('t_nota.t_nota_detail', compact('datas','dataBaru','hargaSubtotal','taxHarga','hargaTotal'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
