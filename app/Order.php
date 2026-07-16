<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'user_id',

        'pharmacy_id',

        'medicine_id',

        'quantity',

        'total_price',

        'status'

    ];

    /**
     * Patient who placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Medicine ordered.
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    /**
     * Pharmacy fulfilling the order.
     */
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}