<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'name_stock', 'amount', 'quantity', 'price', 'date_buy'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    // pembuatan local scope
    public function scopeSearch($query, $value)
    {
        return $query->where('name_stock', 'like', '%'.$value.'%');
    }
}
