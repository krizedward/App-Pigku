<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TOrderOld extends Model
{
    //
    use HasFactory;

    protected $table = 't_order_old'; // nama tabel
    protected $primaryKey = 'id'; // primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'menu_id',
        'date_order',
        'qty_order',
        'total_price',
        'note_order',
        'create_by',
        'update_by',
    ];

    /**
     * Relasi ke model TMenu
     * Satu order berhubungan dengan satu menu
     */
    public function t_menu()
    {
        return $this->belongsTo(TMenu::class, 'menu_id');
    }
}
