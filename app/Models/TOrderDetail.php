<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TOrderDetail extends Model
{
    //
    use HasFactory;

    protected $table = 't_order_detail'; // nama tabel
    protected $primaryKey = 'id'; // primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'order_id',
        'name_menu',
        'qty_order',
        'price_menu',
        'unit_menu',
        'note_order_detail',
        'create_by',
        'update_by',
    ];

    /**
     * Relasi ke model TMenu
     * Satu order berhubungan dengan satu menu
     */
    public function t_order()
    {
        return $this->belongsTo(TOrder::class, 'order_id');
    }
}
