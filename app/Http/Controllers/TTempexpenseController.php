<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TTemporder;
use App\Models\TMenu;
use App\Models\TExpense;
use App\Models\TTempexpense;
use App\Models\MKategori;

class TTempexpenseController extends Controller
{
    protected $data_validate = [
        'kategori_id'        => 'required',
        'payment_id'        => 'required',
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
        $validated = $request->validate($this->data_validate);
        TTempexpense::create($validated);

        if ($request->type_form === 'list_form') {
            return redirect()
                ->back()
                ->with('success', 'Order berhasil ditambahkan!');
        } else {
            return redirect()
                ->route('expense.create')
                ->with('success', 'Order berhasil ditambahkan!');
        }
        // return redirect()->route('expense.create')->with('success', 'Data berhasil disimpan.');
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
        $id = TTempexpense::find($id);
        $id->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
