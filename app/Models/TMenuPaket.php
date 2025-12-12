<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMenuPaket extends Model
{
    //
    use HasFactory;

    protected $table = 't_menu_paket';
    protected $primaryKey = 'id';

    protected $fillable = [
        'menu_id',
    ];

    public function t_menu()
    {
        return $this->belongsTo(TMenu::class, 'menu_id');
    }
}
