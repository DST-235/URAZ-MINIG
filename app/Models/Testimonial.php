<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model {
    use HasTranslations;
    public $translatable = ['quote','author_name','author_position'];
    protected $fillable = ['quote','author_name','author_position','author_company','author_photo','rating','is_active','order'];
    protected $casts = ['is_active'=>'boolean','rating'=>'integer','order'=>'integer'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('order'); }
}
