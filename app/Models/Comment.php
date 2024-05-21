<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =['name', 'email', 'content', 'parent_id', 'post_id', 'likes', 'dislikes' ];


    /**
     * @return string
     */
    public function getInitialsAttribute()
    {
        $firstName =  explode(" ", $this->name)[0];

        $lastName = explode(" ", $this->name)[1] ?? "";

        $initials = '';

        $initials .= $firstName ? Str::substr($firstName, 0, 1) : '';

        $initials .= $lastName ? Str::substr($lastName, 0, 1) : '';

        return $initials;
    }
}
