<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentlog extends Model
{
    use HasFactory;

    protected $table = "paymentlogs";
    protected $fillable = [
        'amount',
        'name_on_card',
        'response_code',
        'transaction_id',
        'auth_id',
        'message_code',
        'qty'    
    ];
}
