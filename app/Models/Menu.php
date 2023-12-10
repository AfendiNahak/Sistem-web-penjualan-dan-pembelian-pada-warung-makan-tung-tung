<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
