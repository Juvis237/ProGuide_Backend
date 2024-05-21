<?php

namespace App\Models;

use App\Traits\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class testimonial extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [

        'name', 'company', 'testimony', 'image'
    ];
    public function coverImage(){
        return asset('storage/' . $this->image);
    }

    public $timestamps = true;
}
