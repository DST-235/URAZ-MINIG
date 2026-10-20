<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Operation extends Model {
    use HasTranslations;
    public $translatable = ['title','description','location'];
    protected $fillable = ['title','description','location','category','image','tags','active_since','is_featured','is_active','order'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean','order'=>'integer','active_since'=>'date'];
    public function scopeActive($q) { return $q->where('is_active',true); }
    public function scopeFeatured($q) { return $q->where('is_featured',true); }
}
