<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRole extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'm_role';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at


    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'name_role',
        'note_role',
        'is_active',
        'create_by',
        'update_by',
    ];

    // Jika kamu ingin menonaktifkan timestamps (created_at, updated_at), ubah ini:
    // public $timestamps = false;
    
    // Jika kamu ingin mendefinisikan default values
    // protected $attributes = [
    //     'is_active' => 'Y',
    // ];

    // t_pengguna ↔ m_role
    // Many-to-Many melalui t_role

    // public function pengguna() {
    //     return $this->belongsToMany(TPengguna::class, 't_role', 'role_id', 'pengguna_id');
    // }
}
