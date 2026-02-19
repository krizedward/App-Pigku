<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TOrder extends Model
{
    //
    use HasFactory;

    protected $table = 't_order'; // nama tabel
    protected $primaryKey = 'id'; // primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'code_order',
        'date_order',
        'time_order',
        'total_item',
        'total_price',
        'note_order',
        'cashier_name',
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
