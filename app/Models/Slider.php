<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model {
    use HasTranslations;
    public $translatable = ['title','subtitle','button_text'];
    protected $fillable = ['page_key','image','title','subtitle','button_text','button_link','text_align','order','is_active','overlay_color'];
    protected $casts = ['is_active'=>'boolean','order'=>'integer'];

    public static function forPage(string $key) {
        return static::where('page_key',$key)->where('is_active',true)->orderBy('order')->get();
    }
}
