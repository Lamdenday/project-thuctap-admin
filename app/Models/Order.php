<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable =
    [
        'id',
        'user_id',
        'phone',
        'address',
        'city',
        'state',
        'zipCode',
        'cardName',
        'cardNumber',
        'expDate',
        'cvv',
        'shippingFee',
        'total',
        'status',
        'name',
    ];

    public function scopeSearchWithName($query, $name)
    {
        return $name ? $query->where('CardName', 'like', '%' . $name . '%') : null;
    }
}
