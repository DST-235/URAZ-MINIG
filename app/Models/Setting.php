<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model {
    protected $fillable = ['key','value','group'];
    protected $casts = ['value'=>'array'];

    public static function get(string $key, $default = null) {
        $setting = static::where('key',$key)->first();
        if (!$setting) return $default;
        $val = $setting->value;
        if (is_array($val) && isset($val[app()->getLocale()])) return $val[app()->getLocale()];
        if (is_array($val) && isset($val['en'])) return $val['en'];
        return $val ?? $default;
    }

    public static function getAll(string $group = null): array {
        $q = static::query();
        if ($group) $q->where('group',$group);
        return $q->get()->keyBy('key')->map(fn($s) => $s->value)->toArray();
    }
}
