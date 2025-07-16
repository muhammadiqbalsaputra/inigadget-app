<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OsType extends Model
{
    protected $table = 'os_types';

    protected $fillable = ['name'];

    /**
     * Relasi ke Produk
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
