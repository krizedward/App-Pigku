<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TSale extends Model
{
    //
    use HasFactory;

    protected $table = 't_sale';

    protected $fillable = [
        'order_id',
        'payment_id',
        'subtotal_sale',
        'tax_sale',
        'discount_sale',
        'total_sale',
        'paid_sale',
        'change_sale',
        'status_sale',
        'note_sale',
        'create_by',
        'update_by',
        // 'name_menu',
        // 'price_menu',
        // 'date_order',
        // 'qty_order',
        // 'total_price',
        // 'note_sale',
        // 'create_by',
        // 'update_by',
    ];

    /**
     * Relasi ke model TOrder
     * Satu order berhubungan dengan satu menu
     */
    public function t_order()
    {
        return $this->belongsTo(TOrder::class, 'order_id');
    }

    /**
     * Relasi ke model MPayment
     * Satu payment berhubungan dengan satu menu
     */
    public function m_payment()
    {
        return $this->belongsTo(MPayment::class, 'payment_id');
    }
}
