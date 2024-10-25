<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = [
        'item_id',
        'quantity',
        'year',
        'number',
        'good',
        'not_good',
        'bad',
        'information',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
