<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'description',
    ];

    // Additional properties and methods can go here
}
