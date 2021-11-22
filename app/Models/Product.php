<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'location_id',
        'product_type_id'
    ];

    /**
     * Get the product that are in a location.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the product that the product type.
     */
    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }

    /**
     * Get the product for login user
     */
    public function scopeUserProducts($query)
    {
        return $query->where('location_id', Auth::user()->location_id);
    }

}
