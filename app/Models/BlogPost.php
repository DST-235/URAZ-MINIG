<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model {
    use HasTranslations;
    public $translatable = ['title','excerpt','content','category'];
    protected $fillable = ['title','excerpt','content','category','image','slug','author_id','is_published','published_at','is_featured'];
    protected $casts = ['is_published'=>'boolean','is_featured'=>'boolean','published_at'=>'datetime'];
    public function author() { return $this->belongsTo(User::class,'author_id'); }
    public function scopePublished($q) { return $q->where('is_published',true); }
    public function scopeFeatured($q) { return $q->where('is_featured',true); }
}
