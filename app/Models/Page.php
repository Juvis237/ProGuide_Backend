<?php

namespace App\Models;

use App\Traits\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use Localization;

    public function __construct(array $attr = [])
    {
        parent::__construct($attr);
        $this->i18n_fields = ['title', 'content'];
    }
    protected $fillable = ['title', 'content'];
}
