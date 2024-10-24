<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];

    public function scopeFilter($building, $params)
    {
        $building->where(function ($building) use ($params) {
            if (!empty($params['search'])) {
                $building->where('name', 'like', '%' . $params['search'] . '%');
            }
        });
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
