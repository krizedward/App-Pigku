<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TOrderDetail;
use App\Models\TOrder;
use App\Models\TMenu;
use App\Models\MPayment;
use App\Models\TSale;
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
        // $payment = MPayment::where('id','5')->orWhere('id','6')->get();
        $payment = MPayment::whereIn('id', [5, 6])->get();

        if (!$order) {
            abort(404, 'Order tidak ditemukan');
        }

        $statusNota = $order->t_sale->status_sale ?? 'unpaid';
        
        $hargaSubtotal = $order->total_price;
        $taxHarga = 0.0 * $hargaSubtotal;
        $hargaTotal = $hargaSubtotal + $taxHarga;
        $totalShop = $hargaTotal;
        $dataBaru = TOrderDetail::where('order_id', $order->id)->get();
        $hargaTotal = 'Rp. ' . number_format($hargaTotal, 0, ',', '.');
        // return $dataBaru;
        $menu = TMenu::all();
        $nota_id = $id;

        return view('t_nota.t_nota_detail', compact('datas','dataBaru','hargaSubtotal','taxHarga','hargaTotal','menu','nota_id','payment','totalShop', 'statusNota', 'order'));
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
        // return 'edit';
        $data = [];
        $order = TOrder::where('code_order', $id)->first();

        $datas = TOrderDetail::where('order_id', $order->id)->get();

        return view('t_nota.t_nota_edit', compact('data', 'datas', 'order'));
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
        $orderDetail = TOrderDetail::find($id);

        if (!$orderDetail) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $code = $orderDetail->code_order;
        $orderID = $orderDetail->order_id;
        $totalHarga = $orderDetail->qty_order * $orderDetail->price_menu;

        $order = TOrder::find($orderID);
        
        $order->total_price -= $totalHarga;
        $order->total_item  -= 1;
        $order->save();

        $orderDetail->delete();

        if (!$code) {
            return redirect()->back()->with('error', 'Kode order tidak ditemukan.');
        }

        return redirect()->route('nota.edit', ['id' => $code])
            ->with('success', 'Data berhasil dihapus.');
    }

    public function payment(Request $request, $order_id)
    {
        $validated = $request->validate([
            // 'order_id' => 'required',
            'payment_id' => 'required',
            'paid_sale' => 'required',
            // 'subtotal_sale' => 'required|numeric',
            // 'tax_sale' => 'required|numeric',
            // 'discount_sale' => 'required|numeric',
            // 'total_sale' => 'required|numeric',
            // 'paid_sale' => 'required|numeric',
            'change_sale' => 'required',
            // 'status_sale' => 'required',
            // 'note_sale' => 'nullable',

            // 'is_active' => 'required|in:Y,N'
        ]);
        $paid_sale = $validated['paid_sale'];
        // Ambil satu order berdasarkan code_order
        $order = TOrder::where('code_order', $order_id)->firstOrFail();

        // Contoh perhitungan pajak (misalnya 11%)
        $tax = $order->total_price * 0;
        
        TSale::create([
            'order_id'      => $order->id,
            'payment_id'    => $validated['payment_id'],
            'subtotal_sale' => $order->total_price,
            'tax_sale'      => $tax,
            'total_sale'    => $order->total_price + $tax,
            'paid_sale'     => $paid_sale,
            'change_sale'   => $validated['change_sale'] + $tax,
            'status_sale'   => 'paid',
        ]);

        // $data = TOrder::where('code_order', $order_id)->get();
        // TSale::create([
        //     'payment_id' => $order_id,
        //     'subtotal_sale' => $data->subtotal_sale,
        //     'tax_sale' => perbaiki
        // ]);

        return redirect()->back();

        // return $data;

        // TSale::create($validated);

        return view('t_nota.t_nota_payment');
    }
}
