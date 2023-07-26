<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'price',
        'image',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function details()
    {
        return $this->hasMany(ProductDetail::class);
    }
    public function getBy($dataSearch, $categoryId)
    {
        return $this->whereHas('category', fn ($q) => $q->where('category_id', $categoryId))->paginate(3);
    }
}
