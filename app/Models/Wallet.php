<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    // Define the table if it doesn't follow Laravel's naming convention
    protected $table = 'wallet';

    // Define the fillable properties
    protected $fillable = [
        'user_id',
        'balance',
    ];
}
