<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TTempmenudetail extends Model
{
    //
    use HasFactory;

    protected $table = 't_tempmenudetail'; // nama tabel
    protected $primaryKey = 'id'; // primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'paket_id',
        'menu_id',
        'qty_menu',
    ];

    public function t_menu()
    {
        return $this->belongsTo(TMenu::class, 'menu_id');
    }

    public function t_menu_paket()
    {
        return $this->belongsTo(TMenuPaket::class, 'paket_id');
    }
}
