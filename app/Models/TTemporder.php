<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TTemporder extends Model
{
    //
    use HasFactory;

    protected $table = 't_temporder'; // nama tabel
    protected $primaryKey = 'id'; // primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'menu_id',
        'date_order',
        'name_menu',
        'price_menu',
        'qty_menu',
        'subtotal_price',
    ];

    public function t_menu()
    {
        return $this->belongsTo(TMenu::class, 'menu_id');
    }
}
