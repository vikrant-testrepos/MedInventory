<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [

        'medicine_id',

        'batch_no',

        'supplier',

        'stock',

        'purchase_price',

        'selling_price',

        'expiry_date'

    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function history()
    {
        return $this->hasMany(StockHistory::class);
    }
}