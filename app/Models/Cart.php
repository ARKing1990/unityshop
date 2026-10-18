<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected  $table = "carts";
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',

    ];

    public function userID()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function productID()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
