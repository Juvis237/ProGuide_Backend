<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'delivrable_id', 'mode_id', 'status', 'assigned_to', 'date', 'rating', 'comment','user_data', 'scan_copy'

    ];


    protected $casts = [
        'date'=>'datetime'
    ];


    const STATUS_DRAFT = "draft";
    const STATUS_PENDING = "pending";
    const STATUS_PROCESSING = "processing";
    const STATUS_ASSIGNED = "assigned";
    const STATUS_RECEIVED = "received";
    const STATUS_COMPLETED = "completed";
    const STATUS_CANCELLED = "cancelled";

    const STATUS = [
        self::STATUS_DRAFT, self::STATUS_PENDING, self::STATUS_PROCESSING, self::STATUS_ASSIGNED, self::STATUS_COMPLETED, self::STATUS_CANCELLED, self::STATUS_RECEIVED
    ];

    public function images(){
        return $this->morphMany(Images::class, 'imageable');
    }

    public function documents(){
        return $this->morphMany(ApplicationDocument::class, 'documentable');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Delivrable(){
        return $this->belongsTo(Delivrable::class, 'delivrable_id');
    }
    public function mode(){
        return $this->belongsTo(DelivrableMode::class,'mode_id');
    }
    public function assignedTo(){
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function payment(){
        return $this->hasOne(Payment::class,'request_id');
    }

}