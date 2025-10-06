<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['nama', 'category_id', 'harga', 'stok', 'foto', 'deskripsi'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
