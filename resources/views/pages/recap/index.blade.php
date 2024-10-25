<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rekap Data
        </h2>
        <div class="text-sm text-gray-500">Lihat rekap data terbaru di sini</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-md p-4 mb-4">
                <div class="flex justify-between mb-3">
                  <div class="flex-col">
                      <div class="font-semibold text-lg text-gray-800 leading-tight mb-2">Jenis Rekap</div>
                      <div class="bg-[#275279] hover:bg-[#142c41] rounded-full text-white px-12 py-2 text-center text-sm cursor-pointer">Ruangan</div>
                  </div>
                </div>
            </div>

            <div class="bg-white rounded-md p-4 mb-4">
                <form>
                    <div class="flex justify-between mb-3 gap-3">
                        <div class="flex gap-2">
                            <div>
                                <select id="building" onchange="this.form.submit()" name="building"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-56 max-w-full p-2.5 ">
                                    <option selected value="">Semua Gedung</option>
                                    @foreach ($buildings as $building)
                                        <option value="{{ $building->id }}"
                                            {{ request('building') == $building->id ? 'selected' : '' }}>
                                            {{ $building->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex">
                                <select name="year" onchange="this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40 max-w-full p-2.5 ">
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = date('Y'); $i >= 2023; $i--)
                                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="flex gap-2">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari Data..."
                                    class="border border-gray-300 rounded-md px-3 py-2 text-sm w-96 max-w-full focus:ring-blue-500 focus:border-blue-500">
                                <button type="submit"
                                    class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">Cari</button>
                            </div>
                        </div>
                        <div class="flex">
                            <a href="{{ route('recap.export') }}" target="_blank"
                                class="bg-blue-950  text-white rounded-md text-sm py-2 px-3 items-center flex">Export
                                Rekap</a>
                        </div>
                    </div>
                </form>
            </div>

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
        </div>
    </div>
</x-app-layout>
