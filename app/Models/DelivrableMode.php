<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelivrableMode extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'duration',
        'delivrable_id'
    ];
}
