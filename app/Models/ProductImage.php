<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            unlink(storage_path("app/public/{$image->image_path}"));
        });
    }

    protected $fillable = [
        'product_id',
        'image_path'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
