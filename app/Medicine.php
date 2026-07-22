<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [

        'pharmacy_id',

        'category_id',

        'name',

        'company',

        'price',

        'cost_price',

        'quantity',

        'description',

        'batch_number',

        'expiry_date',

        'image'

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function stockHistory()
    {
        return $this->hasMany(StockHistory::class);
    }
}