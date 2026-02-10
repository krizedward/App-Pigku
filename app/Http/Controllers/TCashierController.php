<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TOrder;
use App\Models\TOrderDetail;
use App\Models\TOrderAdditional;
use App\Models\TSale;
use App\Models\TTemporder;
use App\Models\TDebit;
use App\Models\TKredit;
use App\Models\TMenu;
use App\Models\TMenuPaket;
use App\Models\MKategori;
use App\Models\TTempmenudetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TCashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil menu yang sudah masuk paket
        $menuIdInPaket = TMenuPaket::pluck('menu_id');
        // Konfigurasi kategori
        $categories = [
            'food_product'       => 1,
            'drink_product'      => 2,
            'additional_product' => 3,
            'promo_product' => 4,
        ];

         // Menyimpan hasil query
        $products = [];
        
        foreach ($categories as $key => $kategoriId) {
            $products[$key] = TMenu::where('kategori_id', $kategoriId)
                ->where('is_active', 'Y')
                ->whereNotIn('id', $menuIdInPaket)
                ->get();
        }
        
        $paket_product = TMenu::whereIn('id', $menuIdInPaket)->get();
        $datas = TMenu::all();
        $user = Auth::user()->name;
        $temp_order = TTemporder::all();

        return view('t_cashier.t_cashier', array_merge(
            compact('datas', 'paket_product', 'temp_order'),
            $products
        ));
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
        // return Auth::user()->name;
        $validated = $request->validate([
            'orders'                 => 'required|array',
            'orders.*.menu_id'       => 'required|exists:t_menu,id',
            'orders.*.date_order'    => 'required|date',
            'orders.*.qty_order'     => 'required|integer|min:1',
            'orders.*.price_menu'    => 'required|integer',
            'orders.*.subtotal_price'=> 'required|integer',
        ]);
        
        $menuIds = [1,5,6,7,8,9,10,18,19,20];
        $IdPertusuk = [3,4];
        $IdPerGelas = [2,11,12,13,14,15,16,17];
        $grandTotal = 0;   // variabel penampung 
        $totalItem  = 0;
        $lastDate   = null;
        // $tanggal = $request->date_form;
        $user = Auth::user()->name;
        $tanggal = Carbon::parse($request->date_form);
        $dateFormat = $tanggal->format('ymd'); // 260129

        // Ambil order terakhir di tanggal yang sama
        $lastOrder = TOrder::whereDate('date_order', $tanggal)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastOrder) {
            // Ambil nomor urutan dari kode terakhir
            $lastNumber = (int) substr($lastOrder->code_order, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Format jadi 4 digit
        $sequence = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Gabungkan jadi kode order
        $codeOrder = "ORD-$dateFormat-$sequence";

        $order = TOrder::create([
            'code_order'   => $codeOrder,
            'date_order'   => $tanggal,
            'total_item'   => '0',
            'total_price'  => '0',
            'note_order'   => '',
            'create_by'    => $user,
            'update_by'    => $user,
        ]);

        foreach ($validated['orders'] as $orderData) {
            $type_additional = null;

            $menu = TMenu::findOrFail($orderData['menu_id']);
            $totalPrice = $menu->price_menu * $orderData['qty_order'];

            if(in_array($menu->id, $menuIds)) {
                $type_additional = 'porsi';
            } elseif(in_array($menu->id, $IdPertusuk)) {
                $type_additional = 'tusuk';
            } elseif(in_array($menu->id, $IdPerGelas)) {
                $type_additional = 'gelas/botol';
            }

            if(!$type_additional) {
                throw new \Exception('Menu tidak terdaftar additional');
            }

            $order_detail_id = TOrderDetail::create([
                'order_id'    => $order->id,
                'name_menu'   => $menu->name_menu,
                'qty_order'   => $orderData['qty_order'],
                'price_menu'  => $menu->price_menu,
                'unit_menu'   => $type_additional,
                'create_by'   => $user, 
                'update_by'   => $user, 
            ]);

            // TOrderAdditional::create([
            //     'order_id'          => $order->id,
            //     'order_detail_id'   => $order_detail_id->id,
            //     'name_menu'         => $menu->name_menu,
            //     'type_additional'   => $type_additional,
            //     'value_additional'  => $orderData['qty_order'],
            // ]);

            // Tambahkan ke grand total
            $grandTotal += $totalPrice;
            $totalItem++;

            // Simpan tanggal terakhir (untuk debit)
            $lastDate = $orderData['date_order'];
        }

        $order->update([
            'total_price' => $grandTotal,
            'total_item'  => $totalItem,
        ]);

        // Setelah loop selesai, baru simpan ke TDebit
        // if ($lastDate) {
        //     TDebit::create([
        //         'date_debit'        => $lastDate,
        //         'description_debit' => "Total Penjualan " . \Carbon\Carbon::parse($lastDate)->translatedFormat('d F Y'),
        //         'amount_debit'      => $grandTotal, // total semua order
        //         'note_debit'        => 'Auto-generated from order',
        //         'create_by'         => $user,
        //         'update_by'         => $user,
        //     ]);
        // }

        // Kosongkan temp order setelah dipindahkan
        TTemporder::truncate();



        return redirect()->route('nota.index')->with('success', 'Semua order berhasil disimpan!');
        
        // if ($request->type_form === 'list_form') {
        //     return redirect()
        //         ->route('t_order.list', ['date' => $tanggal])
        //         ->with('success', 'Order berhasil ditambahkan!');
        // } elseif ($request->type_form === 'cashier') {
        //     return redirect()
        //         ->route('t_sale.list', ['date' => $tanggal])
        //         ->with('success', 'Order berhasil ditambahkan!');
        // } else {
        //     return redirect()->route('order.index')
        //     ->with('success', 'Semua order berhasil disimpan!');
        // }
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
