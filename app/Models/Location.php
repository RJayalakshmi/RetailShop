<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the users of location.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the products of location.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
