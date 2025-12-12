<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BRoleMenu extends Model
{
    //
    use HasFactory;

    protected $table = 'b_role_menu';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at

    protected $fillable = [
        'trole_id',
        'bmenu_id',
        'note_b_role_menu',
        'is_active',
        'create_by',
        'update_by',
    ];

    // Relasi ke tabel t_role
    public function t_role()
    {
        // return $this->hasOne(TRole::class, 'trole_id');
        return $this->belongsTo(TRole::class, 'trole_id');
    }

    // Relasi ke tabel b_menu
    public function b_menu()
    {
        // return $this->hasOne(BMenu::class, 'bmenu_id');
        return $this->belongsTo(BMenu::class, 'bmenu_id');
    }
}
