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
        'name_menu',
        'price_menu',
        'date_order',
        'qty_order',
        'total_price',
        'note_sale',
        'create_by',
        'update_by',
    ];
}
