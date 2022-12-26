<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'status', 'date_order', 'total'];

    protected $dates = ['date_order'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }

    // pembuatan local scope
    public function scopeSearch($query, $value)
    {
        return $query->where('id', 'like', '%'.$value.'%')
            ->orWhere(function($query2) use($value){
                $query2->whereDate('date_order', $value);
                    // query search by year
                    // ->orWhere(function($query3) use($value) {
                    //     $query3->whereYear('date_order', $value);
                    // });
            })
            ->orWhere(function($query2) use($value){
                $query2->whereDay('date_order', $value);
            })
            ->orWhere(function($query2) use($value){
                $query2->whereMonth('date_order', $value);
            })
            ->orWhere(function ($query2) use ($value) {
                $query2->whereHas('user', function($query3) use ($value) {
                    $query3->where('name', 'like', '%'.$value.'%'); 
                });
            });
    }
}
