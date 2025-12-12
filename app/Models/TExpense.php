<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TExpense extends Model
{
    //
    use HasFactory;

    protected $table = 't_expense';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at

    protected $fillable = [
        'kategori_id',
        'payment_id',
        'date_expense',
        'description_expense',
        'total_price',
        'note_expense',
        'create_by',
        'update_by',
    ];

    // Relasi many-to-many ke villa
    public function m_kategori()
    {
        return $this->belongsTo(MKategori::class, 'kategori_id', 'id');
    }

    public function m_payment()
    {
        return $this->belongsTo(MPayment::class, 'payment_id', 'id');
    }
}
