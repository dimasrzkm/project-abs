<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembukuan extends Model
{
    use HasFactory;

    protected $table = 'pembukuan';

    protected $fillable = ['jumlah', 'nominal_masuk', 'nominal_keluar', 'keterangan', 'tanggal', 'order_id'];

    protected $dates = ['tanggal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // pembuatan local scope
    public function scopeSearch($query, $value)
    {
        return $query->where(function ($query2) use ($value) {
            $query2->whereDate('tanggal', $value);
        })
            ->orWhere(function ($query2) use ($value) {
                $query2->whereDay('tanggal', $value);
            })
            ->orWhere(function ($query2) use ($value) {
                $query2->whereMonth('tanggal', $value);
            })
            ->orWhere(function ($query2) use ($value) {
                $query2->where('nominal_keluar', 'like', '%'.$value.'%');
            })
            ->orWhere(function ($query2) use ($value) {
                $query2->where('nominal_masuk', 'like', '%'.$value.'%');
            })
            ->orWhere(function ($query2) use ($value) {
                $query2->where('keterangan', 'like', '%'.$value.'%');
            });
    }
}
