<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MBarang extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'm_barang';

    protected $fillable = [
        'name_barang',
        'brand_barang',
        'volume_barang',
        'satuan_id',
        'note_barang',
        'is_active',
        // 'nama_barang',
        // 'slug_barang',
        // 'kode_barang',
        // 'note_barang',
        // 'is_active',
        // 'status_barang',
        // 'deskripsi_barang'
    ];

    public function m_satuan()
    {
        return $this->belongsTo(MSatuan::class, 'satuan_id');
    }
}
