<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKategori extends Model
{
    //
    use HasFactory;

    protected $table = 'm_kategori';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at

    protected $fillable = [
        'name_kategori',
        'note_kategori',
        'is_active',
        // 'created_by',
        // 'updated_by'
    ];

    // Relasi many-to-many ke villa
    // public function villas()
    // {
    //     return $this->belongsToMany(Villa::class, 't_contact_villa', 'contact_id', 'villa_id');
    // }
}
