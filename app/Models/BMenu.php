<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BMenu extends Model
{
    //
    use HasFactory;

    protected $table = 'b_menu';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    // public $timestamps = true; // Aktifkan created_at & updated_at
    public $timestamps = false;
    
    protected $fillable = [
        'menu_code',
        'menu_category_code',
        'menu_name',
        'menu_host',
        'update_url',
        'menu_order',
        'menu_type',
    ];
}
