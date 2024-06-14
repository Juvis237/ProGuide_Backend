<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function delivrables() {

        return $this->hasMany(Delivrable::class,'school_id');
    }
}
