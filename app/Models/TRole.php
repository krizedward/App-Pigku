<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TRole extends Model
{
    //
    use HasFactory;

    protected $table = 't_role';

    protected $fillable = [
        'role_id',
        'pengguna_id',
        'note_role',
        'is_active',
    ];

    /**
     * Relasi ke tabel m_role
     * Setiap t_role memiliki satu role dari tabel m_role.
     */
    public function m_role()
    {
        return $this->belongsTo(MRole::class, 'role_id');
    }

    /**
     * Relasi ke tabel t_pengguna
     * Setiap t_role terhubung ke satu pengguna.
     */
    public function t_pengguna()
    {
        return $this->belongsTo(TPengguna::class, 'pengguna_id');
    }

    // public function pengguna() {
    //     return $this->belongsTo(TPengguna::class);
    // }

    // public function role() {
    //     return $this->belongsTo(MRole::class);
    // }
}
