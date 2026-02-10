<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TOrder;
use App\Models\TOrderOld;
use App\Models\TTemporder;
use App\Models\TMenu;
use App\Models\TDebit;
use App\Models\TKredit;
use Illuminate\Support\Facades\Auth;

class TOrderOldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $orders = TOrder::all();
        $orders = TOrderOld::orderBy('date_order', 'desc')->get();
        return view('t_order_old.t_order_old', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $temp_order = TTemporder::all();
        $menu = TMenu::all();
        return view('t_order_old.t_order_old_create', compact('temp_order','menu'));
    }

    public function listCreate($date)
    {
        //
        // Pastikan format tanggal valid
        $tanggal = \Carbon\Carbon::parse($date)->format('Y-m-d');
        $temp_order = TTemporder::all();
        $menu = TMenu::all();
        return view('t_order_old.list_order_old_create', compact('tanggal', 'temp_order','menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return Auth::user()->name;
        $validated = $request->validate([
            'orders'                 => 'required|array',
            'orders.*.menu_id'       => 'required|exists:t_menu,id',
            'orders.*.date_order'    => 'required|date',
            'orders.*.qty_order'     => 'required|integer|min:1',
            // 'orders.*.price_menu'    => 'required|integer',
            'orders.*.subtotal_price'=> 'required|integer',
        ]);

        $grandTotal = 0;   // variabel penampung total
        $lastDate   = null;
        $tanggal = $request->date_form;
        $user = Auth::user()->name;

        foreach ($validated['orders'] as $orderData) {
            $menu = TMenu::findOrFail($orderData['menu_id']);
            $totalPrice = $menu->price_menu * $orderData['qty_order'];

            TOrderOld::create([
                'menu_id'     => $orderData['menu_id'],
                'date_order'  => $orderData['date_order'],
                'qty_order'   => $orderData['qty_order'],
                'total_price' => $totalPrice,
                'create_by'   => $user, 
                'update_by'   => $user, 
            ]);

            // Tambahkan ke grand total
            $grandTotal += $totalPrice;

            // Simpan tanggal terakhir (untuk debit)
            $lastDate = $orderData['date_order'];
        }

        // Setelah loop selesai, baru simpan ke TDebit
        if ($lastDate) {
            TDebit::create([
                'date_debit'        => $lastDate,
                'description_debit' => "Total Penjualan " . \Carbon\Carbon::parse($lastDate)->translatedFormat('d F Y'),
                'amount_debit'      => $grandTotal, // total semua order
                'note_debit'        => 'Auto-generated from order',
                'create_by'         => $user,
                'update_by'         => $user,
            ]);
        }

        // Kosongkan temp order setelah dipindahkan
        TTemporder::truncate();

        if ($request->type_form === 'list_form') {
            return redirect()
                ->route('t_order.list', ['date' => $tanggal])
                ->with('success', 'Order berhasil ditambahkan!');
        } else {
            return redirect()->route('order.index')
            ->with('success', 'Semua order berhasil disimpan!');
        }
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
        $id = TOrderOld::find($id);
        $id->delete();
        return redirect()->route('order.index')->with('success', 'Data berhasil dihapus.');
    }

    public function pilihTanggal()
    {
        // Ambil semua tanggal order unik
        $dates = TOrderOld::select('date_order')
            ->distinct()
            ->orderBy('date_order', 'desc')
            ->get();
        // Hitung total pendapatan dari TDebit
        $totalPendapatan = TDebit::sum('amount_debit'); // ganti 'jumlah' dengan nama kolom nominal di tabelmu
        $totalPengeluaran = TKredit::sum('amount_kredit'); // ganti 'jumlah' dengan nama kolom nominal di tabelmu
        $totalBalance = $totalPendapatan - $totalPengeluaran;

        return view('t_order_old.pilih_tanggal', compact('dates', 'totalPendapatan', 'totalPengeluaran', 'totalBalance'));
    }

    public function listByDate($date)
    {
        $orders = TOrderOld::with('t_menu')
            ->where('date_order', $date)
            ->get();

        $totalSemua = $orders->sum('total_price');

        return view('t_order_old.list_order_old', compact('orders', 'date', 'totalSemua'));
    }
}
