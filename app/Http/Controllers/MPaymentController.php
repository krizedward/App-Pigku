<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MPayment;

class MPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datas = MPayment::all();
        return view('m_payment.m_payment', compact('datas'));
        // return 'index payment';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('m_payment.m_payment_create');
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
