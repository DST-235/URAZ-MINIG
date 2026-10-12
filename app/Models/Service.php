<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model {
    use HasTranslations;
    public $translatable = ['name','description','short_description','features'];
    protected $fillable = ['parent_id','name','description','short_description','features','icon','image','slug','order','is_active','show_in_nav'];
    protected $casts = ['is_active'=>'boolean','show_in_nav'=>'boolean','order'=>'integer'];

    public function parent() { return $this->belongsTo(Service::class,'parent_id'); }
    public function children() { return $this->hasMany(Service::class,'parent_id')->orderBy('order'); }
    public function scopeRoot($q) { return $q->whereNull('parent_id'); }
    public function scopeActive($q) { return $q->where('is_active',true); }
}
