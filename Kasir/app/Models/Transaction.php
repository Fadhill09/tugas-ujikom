<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'customer_name', 'table_number', 'total_price', 'total_paid', 'change'
    ];

    public function items() {
        return $this->hasMany(TransactionItem::class);
    }
}

