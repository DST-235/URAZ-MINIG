<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model {
    use HasTranslations;
    public $translatable = ['question','answer'];
    protected $fillable = ['question','answer','page_key','order','is_active'];
    protected $casts = ['is_active'=>'boolean','order'=>'integer'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('order'); }
}
