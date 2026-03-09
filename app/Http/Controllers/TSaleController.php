<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TSale;
use App\Models\TOrder;
use App\Models\MPayment;
use App\Models\TTemporder;
use App\Models\TMenu;
use App\Models\TDebit;
use App\Models\TKredit;
use Illuminate\Support\Facades\Auth;

class TSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datas = TSale::all();
        return view('t_sale.t_sale', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $order = TOrder::all();
        $payment = MPayment::all();
        return view('t_sale.t_sale_create', compact('order','payment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required',
            'payment_id' => 'required',
            'subtotal_sale' => 'required|numeric',
            'tax_sale' => 'required|numeric',
            'discount_sale' => 'required|numeric',
            'total_sale' => 'required|numeric',
            'paid_sale' => 'required|numeric',
            'change_sale' => 'required|numeric',
            'status_sale' => 'required',
            'note_sale' => 'nullable',
            // 'is_active' => 'required|in:Y,N'
        ]);

        TSale::create($validated);

        return redirect()->route('sale.index')
            ->with('success','Data berhasil disimpan');
    }

    public function store_old(Request $request)
    {
        //
        // return Auth::user()->name;
        $validated = $request->validate([
            'orders'                 => 'required|array',
            'orders.*.menu_id'       => 'required|exists:t_menu,id',
            'orders.*.date_order'    => 'required|date',
            'orders.*.qty_order'     => 'required|integer|min:1',
            'orders.*.price_menu'    => 'required|integer',
            'orders.*.subtotal_price'=> 'required|integer',
        ]);

        $grandTotal = 0;   // variabel penampung total
        $lastDate   = null;
        $tanggal = $request->date_form;
        $user = Auth::user()->name;

        foreach ($validated['orders'] as $orderData) {
            $menu = TMenu::findOrFail($orderData['menu_id']);
            $totalPrice = $menu->price_menu * $orderData['qty_order'];

            TSale::create([
                'name_menu'   => $menu->name_menu,
                'date_order'  => $orderData['date_order'],
                'price_menu'  => $menu->price_menu,
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
        } elseif ($request->type_form === 'cashier') {
            return redirect()
                ->route('t_sale.list', ['date' => $tanggal])
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
        $data = TSale::findOrFail($id);
        return view('t_sale.t_sale_edit', compact('data'));
        // return view('t_sale.t_sale_edit', compact('order','payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi
        $validated = $request->validate([
            'order_id' => 'required|string',
            'payment_id' => 'required|string',
            'subtotal_sale' => 'required|numeric',
            'tax_sale' => 'required|numeric',
            'discount_sale' => 'required|numeric',
            'total_sale' => 'required|numeric',
            'paid_sale' => 'required|numeric',
            'change_sale' => 'required|numeric',
            'status_sale' => 'required|string',
            'note_sale' => 'nullable|string',
        ]);

        // Cari data berdasarkan ID
        $sale = TSale::findOrFail($id);

        // Update data
        $sale->update($validated);

        return redirect()->route('sale.index')
            ->with('success', 'Data sale berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $id = TSale::find($id);
        $id->delete();
        return redirect()->route('sale.index')->with('success', 'Data berhasil dihapus.');
    }

    public function pilihTanggal()
    {
        // Ambil semua tanggal order unik
        $dates = TSale::select('date_order')
            ->distinct()
            ->orderBy('date_order', 'desc')
            ->get();
        // Hitung total pendapatan dari TDebit
        $totalPendapatan = TDebit::sum('amount_debit'); // ganti 'jumlah' dengan nama kolom nominal di tabelmu
        $totalPengeluaran = TKredit::sum('amount_kredit'); // ganti 'jumlah' dengan nama kolom nominal di tabelmu
        $totalBalance = $totalPendapatan - $totalPengeluaran;

        return view('t_order.pilih_tanggal', compact('dates', 'totalPendapatan', 'totalPengeluaran', 'totalBalance'));
    }

    public function listByDate($date)
    {
        $orders = TSale::where('date_order', $date)->get();

        $totalSemua = $orders->sum('total_price');

        return view('t_sale.list_sale', compact('orders', 'date', 'totalSemua'));
    }
}
