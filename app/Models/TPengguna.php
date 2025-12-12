<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPengguna extends Model
{
    use HasFactory;

    // Explicitly define the table name (since it doesn’t follow Laravel’s plural naming convention)
    protected $table = 't_pengguna';

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'code_pengguna',
        'fullname_pengguna',
        'username_pengguna',
        'note_pengguna',
        'is_active',
        'create_by',
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel t_role
    public function t_role()
    {
        return $this->hasOne(TRole::class, 'pengguna_id');
    }

    // update baru
    // public function user() 
    // {
    //     return $this->belongsTo(User::class);
    // }

    // t_pengguna ↔ m_role
    // Many-to-Many melalui t_role

    // public function roles() 
    // {
    //     return $this->belongsToMany(MRole::class, 't_role', 'pengguna_id', 'role_id');
    // }
}
