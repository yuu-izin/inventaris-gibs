<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 1cm;
            }
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body class="bg-white p-4">
    <div class="bg-white rounded-md p-4 mb-4">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th rowspan="2" class="px-6 py-3 border">No</th>
                        <th rowspan="2" class="px-6 py-3 border">Nama Barang</th>
                        <th colspan="{{ count($rooms) }}" class="text-center px-6 py-3 border">NAMA RUANG</th>
                        <th rowspan="2" class="px-6 py-3 border">TOTAL</th>
                    </tr>
                    <tr>
                        @foreach ($rooms as $room)
                            <th class="px-6 py-3 border">{{ $room->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $items = [];
                        foreach ($rooms as $roomIndex => $room) {
                            foreach ($room->inventories as $inventory) {
                                $itemId = $inventory->item->id;
                                if (!isset($items[$itemId])) {
                                    $items[$itemId] = [
                                        'name' => $inventory->item->name,
                                        'quantities' => array_fill(0, count($rooms), 0),
                                        'total' => 0,
                                    ];
                                }
                                $items[$itemId]['quantities'][$roomIndex] += $inventory->quantity;
                                $items[$itemId]['total'] += $inventory->quantity;
                            }
                        }
                    @endphp
                    @forelse ($items as $index => $item)
                        <tr class="border">
                            <td class="px-6 py-3 border">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3 border">{{ $item['name'] }}</td>
                            @foreach ($item['quantities'] as $quantity)
                                <td class="px-6 py-3 border">{{ $quantity }}</td>
                            @endforeach
                            <td class="px-6 py-3 border">{{ $item['total'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($rooms) + 3 }}" class="text-center py-3 border">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
we
