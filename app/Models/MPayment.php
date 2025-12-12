<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPayment extends Model
{
    use HasFactory;

    protected $table = 'm_payment';
    protected $primaryKey = 'id'; // Primary key, default 'id'
    public $timestamps = true; // Aktifkan created_at & updated_at

    protected $fillable = [
        'type_payment',
        'description_payment',
        'note_payment',
        'is_active',
        'created_by',
        'updated_by',
    ];
}