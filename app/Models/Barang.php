<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'm_barang';
    // protected $dates = ['deleted_at']; // Menandai deleted_at sebagai tipe tanggal

    protected $fillable = [
        'nama',
        'harga',
        'stok',
        // 'nama_barang',
        // 'slug_barang',
        // 'kode_barang',
        // 'note_barang',
        // 'is_active',
        // 'status_barang',
        // 'deskripsi_barang'
    ];
}
