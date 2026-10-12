<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stat extends Model {
    use HasTranslations;
    public $translatable = ['label','description'];
    protected $fillable = ['icon','value','label','description','order','is_active'];
    protected $casts = ['is_active'=>'boolean','order'=>'integer'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('order'); }
}
