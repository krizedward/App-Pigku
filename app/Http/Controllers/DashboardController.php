<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TExpense;
use App\Models\TOrder;
use App\Models\TOrderOld;
use App\Models\TOrderDetail;
use App\Models\TSale;
use App\Models\TDebit;
use App\Models\TKredit;
use App\Models\TSaldo;
use App\Models\TMenu;
use App\Models\TSaldoLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $roleId = $user?->t_pengguna?->t_role?->m_role?->id;
        $date = Carbon::today();
        $text = ""; // Default kosong

        // if ($roleId == 2) {
            
        //     // Format tanggal
        //     $date_today = Carbon::parse($date)->locale('id')->translatedFormat('l, j F Y');

        //     // Ambil data penjualan
        //     $orders = TOrderOld::with('t_menu')->where('date_order', $date)->get();

        //     // Buat daftar detail + hitung total
        //     $pemasukanList = "";
        //     $totalSales = 0;

        //     foreach ($orders as $order) {
        //         $itemTotal = $order->qty_order * $order->t_menu->price_menu;
        //         $totalSales += $itemTotal;
        //         $formattedValue = number_format($itemTotal, 0, ',', '.');

        //         $pemasukanList .= "- {$order->t_menu->name_menu} : {$order->qty_order} × Rp " . number_format($order->t_menu->price_menu, 0, ',', '.') . " = Rp $formattedValue\n";
        //     }

        //     // Ambil data pengeluaran
        //     $expenses = TExpense::where('date_expense', $date)->get();

        //     $pengeluaranList = "";
        //     $totalExpense = 0;

        //     foreach ($expenses as $expense) {
        //         $totalExpense += $expense->total_price;
        //         $pengeluaranList .= "- {$expense->description_expense} : Rp " . number_format($expense->total_price, 0, ',', '.') . "\n";
        //     }

        //     // Hitung Laba
        //     $labaKotor = $totalSales - $totalExpense;

        //     // format
        //     $totalSalesFormat = number_format($totalSales, 0, ',', '.');
        //     $totalExpenseFormat = number_format($totalExpense, 0, ',', '.');
        //     $labaKotorFormat = number_format($labaKotor, 0, ',', '.');

        //     // Buat final laporan
        //     $text = <<<EOD
        //     $date_today

        //     ==== PENJUALAN ====
        //     $pemasukanList
        //     Total Penjualan: Rp. $totalSalesFormat

        //     ==== PENGELUARAN ====
        //     $pengeluaranList
        //     Total Pengeluaran: Rp. $totalExpenseFormat

        //     ==== RINGKASAN ====\n
        //     Laba Kotor: Rp $labaKotorFormat

        //     EOD;

        //     // ambil input bulan & tahun (jika ada), kalau tidak ada default ke hari ini
        //     $bulan = $request->input('bulan', Carbon::today()->month);
        //     $tahun = $request->input('tahun', Carbon::today()->year);

        //     // Ambil total order per tanggal
        //     $orders = TOrderOld::select('date_order', \DB::raw('SUM(total_price) as total'))
        //         ->whereMonth('date_order', $bulan)
        //         ->whereYear('date_order', $tahun)
        //         ->groupBy('date_order')
        //         ->pluck('total', 'date_order');

        //     // Ambil total expense per tanggal
        //     $expenses = TExpense::select('date_expense', \DB::raw('SUM(total_price) as total'))
        //         ->whereMonth('date_expense', $bulan)
        //         ->whereYear('date_expense', $tahun)
        //         ->groupBy('date_expense')
        //         ->pluck('total', 'date_expense');

        //     // Hanya tampilkan data untuk hari ini saja
        //     $today = Carbon::today()->toDateString();

        //     $dates_2_role = [[
        //         'date'    => $today,
        //         'order'   => $orders[$today] ?? 0,
        //         'expense' => $expenses[$today] ?? 0,
        //     ]];

        //     // $saldoPerusahaan = 0;
        //     // $totalJumlah = 0;
        //     // $totalPertusuk = 0;
        //     // $totalBalance = 0;
        //     // $totalPendapatan = 0;
        //     // $totalPengeluaran = 0;

        //     // return view('dashboard.main', compact('text','dates', 'saldoPerusahaan','totalJumlah','totalPertusuk','totalBalance','totalPendapatan','totalPengeluaran'));

        // } 
        
        // ambil input bulan & tahun (jika ada), kalau tidak ada default ke hari ini
        $bulan = $request->input('bulan', Carbon::today()->month);
        $tahun = $request->input('tahun', Carbon::today()->year);

        // ambil bulan & tahun sebelumnya
        $prevMonth = Carbon::create($tahun, $bulan, 1)->subMonth();
        $bulanLalu = $prevMonth->month;
        $tahunLalu = $prevMonth->year;
        $menuIds = [1,5,6,7,8,9,10,18,19,20,23,24,25,26,27,28,36,37,38];
        $IdPertusuk = [3,4,21,22];
            
        // jumlah total order sate
        // $totalJumlahBaru [versi 0.5.x]
        $totalJumlahBaru = TOrderDetail::join('t_order', 't_order_detail.order_id', '=', 't_order.id')
            ->whereMonth('t_order.date_order', $bulan)
            ->whereYear('t_order.date_order', $tahun)
            ->where('unit_menu','=','porsi')
            ->sum('t_order_detail.qty_order');
        
        $totalJumlahLama = TOrderOld::whereIn('menu_id', $menuIds)
            ->whereMonth('date_order', $bulan)
            ->whereYear('date_order', $tahun)
            ->sum('qty_order');
        
        $totalJumlah = $totalJumlahBaru + $totalJumlahLama;
        
        // return  $totalJumlah;
            
        // jumlah total per tusuk
        // $totalPertusukBaru [versi 0.5.x]
        $totalPertusukBaru = TOrderDetail::join('t_order', 't_order_detail.order_id', '=', 't_order.id')
            ->whereMonth('t_order.date_order', $bulan)
            ->whereYear('t_order.date_order', $tahun)
            ->where('unit_menu','=','tusuk')
            ->sum('t_order_detail.qty_order');
        
        $totalPertusukLama = TOrderOld::whereIn('menu_id', $IdPertusuk)
            ->whereMonth('date_order', $bulan)
            ->whereYear('date_order', $tahun)
            ->sum('qty_order');
        
        $totalPertusuk = $totalPertusukBaru + $totalPertusukLama;
        
        // return  $totalPertusukBaru;

        // Ambil total order per tanggal
        // $ordersBaru [versi 0.5.x]
        // $ordersBaru = TOrderDetail::join('t_order', 't_order_detail.order_id', '=', 't_order.id')
        //     ->select('t_order.date_order', \DB::raw('SUM(total_price) as total'))
        //     ->whereMonth('t_order.date_order', $bulan)
        //     ->whereYear('t_order.date_order', $tahun)
        //     ->groupBy('date_order')
        //     ->pluck('total', 'date_order');
        
        $ordersBaru = TOrder::select('date_order', \DB::raw('SUM(total_price) as total'))
            ->whereMonth('date_order', $bulan)
            ->whereYear('date_order', $tahun)
            ->groupBy('date_order')
            ->pluck('total', 'date_order');

        $ordersLama = TOrderOld::select('date_order', \DB::raw('SUM(total_price) as total'))
            ->whereMonth('date_order', $bulan)
            ->whereYear('date_order', $tahun)
            ->groupBy('date_order')
            ->pluck('total', 'date_order');
        
        // return $ordersLama;
        
        if($ordersLama != null) {
            $orders = $ordersBaru->merge($ordersLama)
                ->groupBy(function ($value, $key) {
                    return $key;
                })
                ->map(function ($items) {
                    return $items->sum();
                });
        } else {
            $orders = $ordersBaru;
        }
        
        // return $orders;

        // $orders = TSale::select('date_order', \DB::raw('SUM(total_price) as total'))
        //     ->whereMonth('date_order', $bulan)
        //     ->whereYear('date_order', $tahun)
        //     ->groupBy('date_order')
        //     ->pluck('total', 'date_order');

        // Ambil total expense per tanggal
        $expenses = TExpense::select('date_expense', \DB::raw('SUM(total_price) as total'))
            ->whereMonth('date_expense', $bulan)
            ->whereYear('date_expense', $tahun)
            ->groupBy('date_expense')
            ->pluck('total', 'date_expense');

        // Tentukan rentang tanggal
        $today = Carbon::today();
        $start = ($today->month == $bulan && $today->year == $tahun)
            ? $today
            : Carbon::create($tahun, $bulan, 1)->endOfMonth();
        
        $end = Carbon::create($tahun, $bulan, 1)->startOfMonth();

        // Generate semua tanggal mundur
        $dates = [];
        for ($date = $start->copy(); $date->gte($end); $date->subDay()) {
            $key = $date->toDateString();
            $dates[] = [
                'date'    => $key,
                'order'   => $orders[$key] ?? 0,
                'expense' => $expenses[$key] ?? 0,
            ];
        }

        // Hitung total pendapatan
        $totalPendapatanBaru = TOrder::whereMonth('date_order', $bulan)
            ->whereYear('date_order', $tahun)
            ->sum('total_price');
        
        $totalPendapatanLama = TDebit::whereMonth('date_debit', $bulan)
            ->whereYear('date_debit', $tahun)
            ->sum('amount_debit');
        
        $totalPendapatan = $totalPendapatanBaru + $totalPendapatanLama;

        // Hitung total pengeluaran
        $totalPengeluaran = TKredit::whereMonth('date_kredit', $bulan)
            ->whereYear('date_kredit', $tahun)
            ->sum('amount_kredit');

        $totalBalance = $totalPendapatan - $totalPengeluaran;

        // Ambil saldo bulan sebelumnya
        $dataSaldo = TSaldo::whereMonth('end_date', $bulanLalu)
            ->whereYear('end_date', $tahunLalu)
            ->latest('id')
            ->first();

        $saldoSebelumnya = $dataSaldo ? $dataSaldo->ending_saldo : 0;
        $saldoPerusahaan = $totalBalance + $saldoSebelumnya;

        // === SIMPAN OTOMATIS KE TSaldo SAAT AKHIR BULAN ===
        $akhirBulan = Carbon::create($tahun, $bulan, 1)->endOfMonth();

        if ($today->isSameDay($akhirBulan)) {
            $cekSaldo = TSaldo::where('start_date', Carbon::create($tahun, $bulan, 1))
                ->where('end_date', $akhirBulan)
                ->first();

            if (!$cekSaldo) {
                TSaldo::create([
                    'start_date'     => Carbon::create($tahun, $bulan, 1),
                    'end_date'       => $akhirBulan,
                    'starting_saldo' => $saldoSebelumnya,
                    'income_saldo'   => $totalPendapatan,
                    'expense_saldo'  => $totalPengeluaran,
                    'ending_saldo'   => $saldoPerusahaan,
                ]);
            }
        }

        // merubah dates untuk ubah data dates
        // if($roleId == 2){
        //     $dates = $dates_2_role;
        // }

        $dataAreaChart = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $dataBarChart = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $dataPieDemo = [1, 1, 1];

        return view('dashboard.main', compact(
            // baru
            'dataAreaChart',
            'dataBarChart',
            'dataPieDemo',
            // parameter lama
            'text',
            'dates',
            'totalPendapatan',
            'totalPengeluaran',
            'totalBalance',
            'saldoPerusahaan',
            'totalJumlah',
            'totalPertusuk',
            'bulan',
            'tahun'
        ));

    }

    public function index_01()
    {
        $today = Carbon::today();
        // $bulan = 9;
        $bulan = $today->month;
        // $tahun = 2025;
        $tahun = $today->year;

        // ambil bulan & tahun sebelumnya
        $prevMonth = $today->copy()->subMonth();
        $bulanLalu = $prevMonth->month;

        //jumlah total order sate
        $totalJumlah = TOrder::where('menu_id', 1)
            ->whereMonth('date_order', $bulan)
            ->whereYear('date_order', $tahun)
            ->sum('qty_order');

        // Ambil total order per tanggal
        $orders = TOrder::select('date_order', \DB::raw('SUM(total_price) as total'))
            ->whereMonth('date_order', $bulan)
            ->whereYear('date_order', $tahun)
            ->groupBy('date_order')
            ->pluck('total', 'date_order'); // langsung jadi array [tanggal => total]

        // Ambil total expense per tanggal
        $expenses = TExpense::select('date_expense', \DB::raw('SUM(total_price) as total'))
            ->whereMonth('date_expense', $bulan)
            ->whereYear('date_expense', $tahun)
            ->groupBy('date_expense')
            ->pluck('total', 'date_expense');

        // Tentukan rentang tanggal
        $start = ($today->month == $bulan && $today->year == $tahun)
            ? $today
            : Carbon::create($tahun, $bulan, 1)->endOfMonth();

        $end = Carbon::create($tahun, $bulan, 1);

        // Generate semua tanggal mundur
        $dates = [];
        for ($date = $start->copy(); $date->gte($end); $date->subDay()) {
            $key = $date->toDateString();
            $dates[] = [
                'date'    => $key,
                'order'   => $orders[$key] ?? 0,
                'expense' => $expenses[$key] ?? 0,
            ];
        }

        // Hitung total pendapatan
        $totalPendapatan = TDebit::whereMonth('date_debit', $bulan)
            ->whereYear('date_debit', $tahun)
            ->sum('amount_debit');

        // Hitung total pengeluaran
        $totalPengeluaran = TKredit::whereMonth('date_kredit', $bulan)
            ->whereYear('date_kredit', $tahun)
            ->sum('amount_kredit');

        $totalBalance = $totalPendapatan - $totalPengeluaran;
        // $dataSaldo = TSaldo::latest('id')->first();

        $dataSaldo = TSaldo::whereMonth('start_date', $bulanLalu)
            ->latest('id')
            ->first();
        // return $dataSaldo;
        // DB::table('transaksi')->latest('id')->first();
        $saldoSebelumnya = $dataSaldo ? $dataSaldo->ending_saldo : 0;
        $saldoPerusahaan = $totalBalance + $saldoSebelumnya;

        // === SIMPAN OTOMATIS KE TSaldo SAAT AKHIR BULAN ===
        $akhirBulan = Carbon::create($tahun, $bulan, 1)->endOfMonth();
        
        if ($today->isSameDay($akhirBulan)) {
            // cek apakah sudah ada data saldo untuk bulan ini
            $cekSaldo = TSaldo::where('start_date', Carbon::create($tahun, $bulan, 1))
                ->where('end_date', $akhirBulan)
                ->first();  

            if (!$cekSaldo) {
                TSaldo::create([
                    'start_date'     => Carbon::create($tahun, $bulan, 1),
                    'end_date'       => $akhirBulan,
                    'starting_saldo' => $saldoSebelumnya,   // saldo bulan lalu
                    'income_saldo'   => $totalPendapatan,   // total pemasukan bulan ini
                    'expense_saldo'  => $totalPengeluaran,  // total pengeluaran bulan ini
                    'ending_saldo'   => $saldoPerusahaan,   // saldo akhir bulan
                ]);
            }
        }


        return view('dashboard.main', compact('dates', 'totalPendapatan', 'totalPengeluaran', 'totalBalance', 'saldoPerusahaan', 'totalJumlah'));
    }

    public function index_gagal()
    {
        $today = Carbon::today();

        // Default variabel supaya tidak undefined
        $dates = [];
        $totalJumlah = 0;
        $totalPendapatan = 0;
        $totalPengeluaran = 0;
        $totalBalance = 0;
        $saldoPerusahaan = 0;

        // kalau tanggal 1, maka ambil bulan sebelumnya
        if ($today->day == 1) {
            $bulan = $today->copy()->subMonth()->month;
            $tahun = $today->copy()->subMonth()->year;

            // jumlah total order sate bulan lalu
            $totalJumlah = TOrder::where('menu_id', 1)
                ->whereMonth('date_order', $bulan)
                ->whereYear('date_order', $tahun)
                ->sum('qty_order');

            // order per tanggal bulan lalu
            $orders = TOrder::select('date_order', \DB::raw('SUM(total_price) as total'))
                ->whereMonth('date_order', $bulan)
                ->whereYear('date_order', $tahun)
                ->groupBy('date_order')
                ->pluck('total', 'date_order');

            // expense per tanggal bulan lalu
            $expenses = TExpense::select('date_expense', \DB::raw('SUM(total_price) as total'))
                ->whereMonth('date_expense', $bulan)
                ->whereYear('date_expense', $tahun)
                ->groupBy('date_expense')
                ->pluck('total', 'date_expense');

            // generate tanggal bulan lalu
            $startDate = Carbon::create($tahun, $bulan, 1);
            $endDate   = $startDate->copy()->endOfMonth();

            for ($date = $endDate->copy(); $date->gte($startDate); $date->subDay()) {
                $key = $date->toDateString();
                $dates[] = [
                    'date'    => $key,
                    'order'   => $orders[$key] ?? 0,
                    'expense' => $expenses[$key] ?? 0,
                ];
            }

            // total pendapatan bulan lalu
            $totalPendapatan = TDebit::whereMonth('date_debit', $bulan)
                ->whereYear('date_debit', $tahun)
                ->sum('amount_debit');

            // total pengeluaran bulan lalu
            $totalPengeluaran = TKredit::whereMonth('date_kredit', $bulan)
                ->whereYear('date_kredit', $tahun)
                ->sum('amount_kredit');

            $totalBalance = $totalPendapatan - $totalPengeluaran;

            $dataSaldo = TSaldo::latest('id')->first();
            $saldoSebelumnya = $dataSaldo ? $dataSaldo->ending_saldo : 0;
            $saldoPerusahaan = $saldoSebelumnya + $totalBalance;

            // simpan otomatis
            $cekSaldo = TSaldo::where('start_date', $startDate)
                ->where('end_date', $endDate)
                ->first();

            if (!$cekSaldo) {
                TSaldo::create([
                    'start_date'     => $startDate,
                    'end_date'       => $endDate,
                    'starting_saldo' => $saldoSebelumnya,
                    'income_saldo'   => $totalPendapatan,
                    'expense_saldo'  => $totalPengeluaran,
                    'ending_saldo'   => $saldoPerusahaan,
                ]);
            }
        }

        return view('dashboard.main', compact(
            'dates',
            'totalJumlah',
            'totalPendapatan',
            'totalPengeluaran',
            'totalBalance',
            'saldoPerusahaan'
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
