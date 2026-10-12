<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model {
    protected $fillable = ['name','email','phone','subject','message','company','is_read','read_at'];
    protected $casts = ['is_read'=>'boolean','read_at'=>'datetime'];
    public function scopeUnread($q) { return $q->where('is_read',false); }
}
