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

    public function scopeFilter($query, $params)
    {
        $query->where(function ($query) use ($params) {
            if (@$params['search']) {
                $query->where('name', 'like', "%{$params['search']}%");
            }
        });
    }
}
