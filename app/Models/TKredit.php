<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TKredit extends Model
{
    //
    use HasFactory;

    protected $table = 't_kredit';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at

    protected $fillable = [
        'date_kredit',
        'description_kredit',
        'amount_kredit',
        'note_kredit',
        'create_by',
        'update_by',
    ];
}
