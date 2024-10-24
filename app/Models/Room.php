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
    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
