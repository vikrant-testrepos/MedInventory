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

        'batch_number',

        'expiry_date',

        'description',

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

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        return filter_var($this->image, FILTER_VALIDATE_URL)
            ? $this->image
            : asset('uploads/medicines/' . $this->image);
    }

    public function stockHistory()
    {
        return $this->hasMany(StockHistory::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Calculated Attributes
    |--------------------------------------------------------------------------
    */

    public function getProfitPerUnitAttribute()
    {
        return $this->price - $this->cost_price;
    }

    public function getInventoryValueAttribute()
    {
        return $this->cost_price * $this->quantity;
    }

    public function getExpectedProfitAttribute()
    {
        return ($this->price - $this->cost_price) * $this->quantity;
    }
}