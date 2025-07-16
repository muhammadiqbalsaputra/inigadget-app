<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product1 extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'stock',
        'image_url',
        'brand_id',
        'os_type_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Relasi ke Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relasi ke OS Type
    public function ostype()
    {
        return $this->belongsTo(OsType::class, 'os_type_id');
    }
}