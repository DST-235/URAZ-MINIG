<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model {
    use HasTranslations;
    public $translatable = ['name','description','short_description','features'];
    protected $fillable = ['name','description','short_description','features','category','icon','image','slug','order','is_active','show_in_nav'];
    protected $casts = ['is_active'=>'boolean','show_in_nav'=>'boolean','order'=>'integer'];

    public function scopeActive($q) { return $q->where('is_active',true); }
}
