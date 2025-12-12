<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TIncome extends Model
{
    //
    use HasFactory;

    protected $table = 't_income';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at

    protected $fillable = [
        'kategori_id',
        'date_income',
        'description_income',
        'total_price',
        'note_income',
    ];

    // Relasi many-to-many ke villa
    public function m_kategori()
    {
        return $this->belongsTo(MKategori::class, 'kategori_id', 'id');
    }

}
