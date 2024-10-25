<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'building_id',
        'name',
        'number',
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('number', 'like', '%' . $filters['search'] . '%');
            });
        }
    }

    public function scopeFilterRecap($query, $params)
    {
        if (@$params['building']) {
            $query->whereHas('building', function ($query) use ($params) {
                $query->where('id', $params['building']);
            });
        }

        // year on inventories
        if (@$params['year']) {
            $query->whereHas('inventories', function ($query) use ($params) {
                $query->where('year', 'like', '%' . $params['year'] . '%');
            });
        }
    }


    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'room_id');
    }
}
