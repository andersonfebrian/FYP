<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public static function boot() {
        parent::boot();

        static::deleting(function($banner) {
            $path = storage_path('app/public');
            unlink($path . '/' . $banner->banner_path);
        });
    }

    protected $fillable = [
        'banner_path',
        'is_viewable',
        'name',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
