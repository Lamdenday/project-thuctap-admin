<?php

namespace App\Models;

use App\Traits\HandleImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HandleImage;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'category_id',
        'price',
        'description',
        'image_url',
    ];

    public function categoryProduct()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getImagePathAttribute()
    {
        return $this->path . $this->image;
    }

    public function scopeSearchWithName($query, $name)
    {
        return $name ? $query->where('title', 'like', '%' . $name . '%') : null;
    }

    public function scopeSearchWithCategoryId($query, $categoryId)
    {
        return $categoryId ? $query->where('category_id', $categoryId) : null;
    }

    public function scopeSearchWithMinPrice($query, $min_price)
    {
        return $min_price ? $query->where('price', '>', $min_price) : null;
    }

    public function scopeSearchWithMaxPrice($query, $max_price)
    {
        return $max_price ? $query->where('price', '<', $max_price) : null;
    }
}
