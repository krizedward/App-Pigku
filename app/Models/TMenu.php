<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMenu extends Model
{
    //
    use HasFactory;

    protected $table = 't_menu';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at

    protected $fillable = [
        'kategori_id',
        'name_menu',
        'price_menu',
        'note_menu',
        'is_active',
        // 'created_by',
        // 'updated_by'
    ];

    // Relasi many-to-many ke villa
    public function m_kategori()
    {
        return $this->belongsTo(MKategori::class, 'kategori_id', 'id');
    }
}
