<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TTemporder;
use App\Models\TMenu;
use App\Models\TExpense;
use App\Models\TTempexpense;
use App\Models\MKategori;
use App\Models\TKredit;
use App\Models\MPayment;
use Illuminate\Support\Facades\Auth;

class TExpenseController extends Controller
{
    protected $data_validate = [
        'kategori_id'        => 'required',
        'payment_id'         => 'required',
        'date_expense'       => 'required|date', // validasi tanggal
        'description_expense'=> 'required|string|max:255',
        'total_price'        => 'required|numeric|min:0',
        'note_expense'       => 'nullable|string',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $orders = TExpense::orderBy('date_order', 'desc')->get();
        $datas = TExpense::orderBy('date_expense', 'desc')->get();
        // $datas = TExpense::all();
        return view('t_expense.t_expense', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $temp_expense = TTempexpense::all();
        $payment = MPayment::all();
        $kategori = MKategori::where('main_kategori', 'Pengeluaran')->get();
        
        return view('t_expense.t_expense_create', compact('temp_expense', 'kategori', 'payment'));
    }

    public function listCreate($date)
    {
        //
        // Pastikan format tanggal valid
        $tanggal = \Carbon\Carbon::parse($date)->format('Y-m-d');
        $temp_expense = TTempexpense::all();
        $payment = MPayment::all();
        $kategori = MKategori::where('main_kategori', 'Pengeluaran')->get();
        
        return view('t_expense.list_expense_create', compact('tanggal','temp_expense', 'kategori', 'payment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expenses'                        => 'required|array',
            'expenses.*.payment_id'           => 'required|exists:m_payment,id',
            'expenses.*.kategori_id'          => 'required|exists:m_kategori,id',
            'expenses.*.date_expense'         => 'required|date',
            'expenses.*.description_expense'  => 'nullable|string',
            'expenses.*.note_expense'         => 'nullable|string',
            'expenses.*.total_price'          => 'required|integer|min:0',
        ]);

        $grandTotal = 0;   // variabel penampung total
        $lastDate   = null;
        $tanggal = $request->date_form;
        $user = Auth::user()->name;

        foreach ($validated['expenses'] as $expenseData) {
            // Buat data expense
            TExpense::create([
                'kategori_id'         => $expenseData['kategori_id'],
                'payment_id'         => $expenseData['payment_id'],
                'description_expense' => $expenseData['description_expense'] ?? null,
                'date_expense'        => $expenseData['date_expense'],
                'note_expense'        => $expenseData['note_expense'] ?? null,
                'total_price'         => $expenseData['total_price'],
                'create_by'   => $user, 
                'update_by'   => $user,
            ]);

            // Tambahkan ke grand total
            $grandTotal += $expenseData['total_price'];

            // Simpan tanggal terakhir (untuk kredit)
            $lastDate = $expenseData['date_expense'];
        }

        // Setelah loop selesai, baru simpan ke TKredit
        if ($lastDate) {
            TKredit::create([
                'date_kredit'        => $lastDate,
                'description_kredit' => "Total Pengeluaran " . \Carbon\Carbon::parse($lastDate)->translatedFormat('d F Y'),
                'amount_kredit'      => $grandTotal, // total semua expense
                'note_kredit'        => 'Auto-generated from expense',
                'create_by'   => $user, 
                'update_by'   => $user,
            ]);
        }

        // Kosongkan temp expense setelah dipindahkan
        TTempexpense::truncate();

        if ($request->type_form === 'list_form') {
            return redirect()
                ->route('expense.list', ['date' => $tanggal])
                ->with('success', 'Order berhasil ditambahkan!');
        } else {
            return redirect()->route('expense.index')
            ->with('success', 'Semua expense berhasil disimpan!');
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
    }

    public function listByDate($date)
    {
        $expenses = TExpense::with('m_kategori')
            ->where('date_expense', $date)
            ->get();

        $totalSemua = $expenses->sum('total_price');

        return view('t_expense.list_expense', compact('expenses', 'date', 'totalSemua'));
    }
}
