<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'name_stock', 'amount', 'quantity', 'price', 'date_buy'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // pembuatan local scope
    public function scopeSearch($query, $value)
    {
        return $query->where('name_stock', 'like', '%'.$value.'%')
        ->orWhere('price', 'like', '%'.$value.'%')
        ->orWhere(function ($query2) use ($value) {
            $query2->whereDate('date_buy', $value);
            // query search by year
            // ->orWhere(function($query3) use($value) {
                //     $query3->whereYear('date_order', $value);
            // });
        })
        ->orWhere(function ($query2) use ($value) {
            $query2->whereMonth('date_buy', $value);
        })
        ->orWhere(function ($query2) use ($value) {
            $query2->whereDay('date_buy', $value);
        })
        ->orWhere(function ($query2) use ($value) {
            $query2->whereHas('user', function ($query3) use ($value) {
                $query3->where('name', 'like', '%'.$value.'%');
            });
        });
        // return $query->whereHas('user', function($query2) use ($value) {
        //     $query2->where('name', 'like', '%'.$value.'%');
        // });
    }
}
