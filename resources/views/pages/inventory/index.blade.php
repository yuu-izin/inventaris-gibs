<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $building->name }}
        </h2>
        <div class="text-sm text-gray-500">Akses menu dan informasi penting lainnya di sini</div>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-md p-4 mb-4">
                <div class="flex justify-between mb-3">
                    <div class="font-semibold text-lg text-gray-800 leading-tight">
                        <table class="w-full">
                            <tr>
                                <td class="pr-4">Nomor Ruang</td>
                                <td>: {{ $room->name }}</td>
                            </tr>
                            <tr>
                                <td class="pr-4">Ruang</td>
                                <td>: {{ $room->number }}</td>
                            </tr>
                            <tr>
                                <td class="pr-4">Tanggal</td>
                                <td>: {{ $room->created_at->format('d-m-Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-md p-4 mb-4">
                <div class="flex justify-between mb-3">
                    <form action="{{ route('inventory.index', ['building' => $building_id, 'room' => $room_id]) }}" method="GET" class="flex items-center space-x-2 w-full md:w-auto">
                        <input type="text" name="search" placeholder="Cari Inventaris..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">Cari</button>
                    </form>
                    <a href="{{ route('inventory.create', ['building' => $building_id, 'room' => $room_id]) }}" class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">Tambah Inventaris</a>
                </div>
            </div>

            <div class="bg-white rounded-md p-4 mb-4">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama Barang</th>
                                <th class="px-6 py-3">Jumlah</th>
                                <th class="px-6 py-3">Merk/Model</th>
                                <th class="px-6 py-3">Warna</th>
                                <th class="px-6 py-3">Keterangan</th>
                                <th class="px-6 py-3">Kondisi Baik</th>
                                <th class="px-6 py-3">Kondisi K.Baik</th>
                                <th class="px-6 py-3">Kondisi Rusak</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $inventory)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $inventory->item->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $inventory->quantity }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $inventory->item->merk }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $inventory->item->color }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $inventory->information }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $inventory->good }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $inventory->not_good }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $inventory->bad }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('inventory.edit', ['building' => $building->id, 'room' => $room->id, 'inventory' => $inventory->id]) }}" class="text-blue-950 hover:underline">Edit</a>
                                    <form action="{{ route('inventory.destroy', ['building' => $building->id, 'room' => $room->id, 'inventory' => $inventory->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
