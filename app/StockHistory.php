<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable = [

        'medicine_id',

        'inventory_id',

        'user_id',

        'action',

        'quantity',

        'stock_before',

        'stock_after',

        'remarks'

    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}