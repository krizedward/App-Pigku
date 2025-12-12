<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TTempexpense extends Model
{
    //
    use HasFactory;

    protected $table = 't_tempexpense'; // nama tabel
    protected $primaryKey = 'id'; // primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kategori_id',
        'payment_id',
        'payment_id',
        'date_expense',
        'description_expense',
        'total_price',
        'note_expense',
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
