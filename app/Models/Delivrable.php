<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivrable extends Model
{
    use HasFactory;

    protected $fillable = ['school_id','name','price', 'duration'];

    public function school() {

        return $this->belongsTo(School::class,'school_id');
    }

    public function modes(){
        return $this->hasMany(DelivrableMode::class,'delivrable_id');
    }
}
