<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Localization;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    use Localization;

    public function __construct(array $attr = [])
    {
        parent::__construct($attr);
        $this->i18n_fields = ['title', 'description', 'image'];
    }
    protected $fillable = [
        'title',
        'image',
        'description',
        'category_id',
        'type',
        'path',
        'status',
        'posted_by',
        'created_at'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function publisher(){
        $publisher = User::find($this->posted_by);
        return $publisher->name;
    }

    public function coverImage(){
        if (app()->getLocale() == 'fr' && $this->image_fr != null) {
            return asset('storage/' . $this->image_fr);
        } else {
            return asset('storage/' . $this->image);
        }
    }

    public function url(){
        if($this->type == 'video'){
            return $this->path;
        }
        else{
            return;
        }
    }

    public function scopeText($builder){
        return $builder->where('type', 'text')->get();
    }


    public function scopeVideo($builder){
        return $builder->where('type', 'video')->get();
    }

    public function comments(){
        return Comment::where('blog_id', $this->id)->get();
    }

    public function related()
    {
        $q = Blog::query()->select('blogs.*');
        return $q->where('status', 'published')->where('category_id', $this->category_id)->get();
    }
}
