<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model {
    use HasTranslations;
    public $translatable = ['title','content','meta_title','meta_description'];
    protected $fillable = ['slug','title','content','meta_title','meta_description','is_active'];
    protected $casts = ['is_active'=>'boolean'];

    public static function findBySlug(string $slug) {
        return static::where('slug',$slug)->where('is_active',true)->first();
    }
}
