<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TSaldoLog extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 't_saldo_log';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'start_date',
        'end_date',
        'starting_saldo',
        'income_saldo',
        'expense_saldo',
        'ending_saldo',
    ];
    //

    // Define relationship with User model
    public function t_saldo()
    {
        return $this->belongsTo(TSaldo::class, 'saldo_id');
    }
}
