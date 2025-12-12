<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMenuDetail extends Model
{
    //
    use HasFactory;

    protected $table = 't_menu_detail';
    protected $primaryKey = 'id';

    protected $fillable = [
        'paket_id',
        'menu_id',
        'qty_menu',
    ];

    public function paket()
    {
        return $this->belongsTo(TMenu::class, 'paket_id');
    }

    public function t_menu()
    {
        return $this->belongsTo(TMenu::class, 'menu_id');
    }
}
