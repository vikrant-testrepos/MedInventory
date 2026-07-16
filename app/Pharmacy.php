<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = [

        'user_id',

        'name',

        'owner_name',

        'license_number',

        'phone',

        'email',

        'district',

        'address',

        'latitude',

        'longitude',

        'logo',

        'opening_time',

        'closing_time',

        'approved'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}