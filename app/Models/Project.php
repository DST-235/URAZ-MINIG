<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model {
    use HasTranslations;
    public $translatable = ['title','description','client','category'];
    protected $fillable = ['title','description','client','category','image','url','technologies','completed_at','is_featured','is_active','order'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean','order'=>'integer','completed_at'=>'date'];
    public function scopeActive($q) { return $q->where('is_active',true); }
    public function scopeFeatured($q) { return $q->where('is_featured',true); }
}
