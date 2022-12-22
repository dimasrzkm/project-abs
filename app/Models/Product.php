<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name_product', 'price', 'stock', 'categorie_id', 'image'];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function stocks()
    {
        // return $this->belongsToMany(Stock::class)->withTimestamps();
        return $this->belongsToMany(Stock::class)->withPivot('total');
    }
    // pembuatan local scope
    public function scopeSearch($query, $value)
    {
        return $query->where('name_product', 'like', '%'.$value.'%');
    }
}
