<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TSaldo extends Model
{
    use HasFactory;
    
    // Nama tabel
    protected $table = 't_saldo';
    
    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'start_date',
        'end_date',
        'starting_saldo',
        'income_saldo',
        'expense_saldo',
        'ending_saldo',
    ];

    // (opsional) jika kamu ingin casting tanggal otomatis ke Carbon
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];
}
