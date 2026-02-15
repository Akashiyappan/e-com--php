<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'address',
        'city',
        'zip',
        'total_amount'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
