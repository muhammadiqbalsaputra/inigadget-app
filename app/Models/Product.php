<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image_url',
        'brand_id',
        'os_type_id',
        'is_active',
    ];

    /**
     * Relasi ke Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relasi ke OS Type
     */
    public function osType()
    {
        return $this->belongsTo(OsType::class);
    }

    /**
     * Scope produk aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
