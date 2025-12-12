<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TDebit extends Model
{
    //
    use HasFactory;

    protected $table = 't_debit';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at

    protected $fillable = [
        'date_debit',
        'description_debit',
        'amount_debit',
        'note_debit',
        'create_by',
        'update_by',
    ];
}
