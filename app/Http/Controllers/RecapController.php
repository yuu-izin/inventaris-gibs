<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Building;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->except('_token');
        $rooms = Room::filterRecap($params)->with(['inventories' => function ($query) use ($params) {
            $query->whereHas('item', function ($query) use ($params) {
                $query->filter($params);
            })->with('item');
        }])->get();

        $buildings = Building::all();

        $data = [
            'rooms' => $rooms,
            'buildings' => $buildings,
        ];
        return view('pages.recap.index', $data);
    }

    public function export(Request $request)
    {
        $params = $request->except('_token');
        $rooms = Room::filterRecap($params)->with(['inventories' => function ($query) use ($params) {
            $query->whereHas('item', function ($query) use ($params) {
                $query->filter($params);
            })->with('item');
        }])->get();

        $buildings = Building::all();

        $data = [
            'rooms' => $rooms,
            'buildings' => $buildings,
        ];

        return view('pages.recap.export', $data);
    }
}
