<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function catatan_pelanggan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
