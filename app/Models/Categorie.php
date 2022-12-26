<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['categorie', 'slug'];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    // pembuatan local scope
    public function scopeSearch($query, $value)
    {
        return $query->where('categorie', 'like', '%'.$value.'%');
    }
}
