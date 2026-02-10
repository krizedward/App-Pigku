<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TOrderAdditional extends Model
{
    //
    use HasFactory;

    protected $table = 't_order_additional'; // nama tabel
    protected $primaryKey = 'id'; // primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'order_id',
        'order_detail_id',
        'type_additional',
        'value_additional',
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

    public function t_order_detail()
    {
        return $this->belongsTo(TOrderDetail::class, 'order_detail_id');
    }
}
