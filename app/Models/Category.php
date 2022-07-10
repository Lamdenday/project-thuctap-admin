<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'title'
    ];


    public function categoryProducts()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSearchWithName($query, $name)
    {
        return $name ? $query->where('title', 'like', '%' . $name . '%') : null;
    }
}
