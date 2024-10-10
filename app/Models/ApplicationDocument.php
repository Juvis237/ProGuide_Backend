<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'documentable_type',
        'documentable_id',
        'document_path',
        'doc_name',
    ];

    /**
     * Get the owning documentable model (polymorphic relationship).
     */
    public function documentable()
    {
        return $this->morphTo();
    }
}