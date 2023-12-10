<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembelian_details()
    {
        return $this->hasMany(DetailPembelian::class);
    }

    public function supplierBrg()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['year'] ?? false, function ($query, $search) {
            return $query->whereYear('created_at', $search);
        });

        $query->when($filters['month'] ?? false, function ($query, $search) {
            return $query->whereMonth('created_at', $search);
        });
    }
}
