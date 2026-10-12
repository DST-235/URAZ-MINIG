<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model {
    use HasTranslations;
    public $translatable = ['name','position','bio'];
    protected $fillable = ['name','position','bio','photo','email','linkedin','twitter','order','is_active'];
    protected $casts = ['is_active'=>'boolean','order'=>'integer'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('order'); }
}
