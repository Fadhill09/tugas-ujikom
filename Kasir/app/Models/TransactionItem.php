<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = ['transaction_id','product_name','qty','price','subtotal'];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}



