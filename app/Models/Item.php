<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'merk',
        'color',
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
