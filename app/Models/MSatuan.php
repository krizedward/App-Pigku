<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSatuan extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'm_satuan';

    protected $fillable = [
        'name_satuan',
        'note_satuan',
        'is_active',
        // 'nama_barang',
        // 'slug_barang',
        // 'kode_barang',
        // 'note_barang',
        // 'is_active',
        // 'status_barang',
        // 'deskripsi_barang'
    ];
}
