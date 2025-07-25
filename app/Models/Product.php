<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute($value)
    {
        if ($value && Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
        }
        return asset('images/vibeshop_no_photo.png');
    }

    public function getPriceAttribute($value)
    {
        return round((float) $value, 2);
    }

    protected $fillable = [
        'name',
        'description',
        'type',
        'price',
        'average_rating',
        'reviews_count',
        'is_available',
        'is_published',
        'image',
        'category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'avarage_rating' => 'float',
        'reviews_count' => 'integer',
        'is_available' => 'boolean',
        'is_published' => 'boolean',
    ];
}
