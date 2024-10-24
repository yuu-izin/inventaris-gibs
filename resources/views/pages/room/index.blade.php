<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $building->name }}
        </h2>
        <div class="text-sm text-gray-500">Akses menu dan informasi penting lainnya di sini</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-md p-4 mb-4">
                <div class="flex justify-between items-center">
                    <form action="{{ route('room.index', $building->id) }}" method="GET" class="flex items-center space-x-2">
                        <input type="text" name="search" placeholder="Cari Ruangan..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">Cari</button>
                    </form>
                    <a href="{{ route('room.create', $building->id) }}" class="bg-blue-950 text-white rounded-md py-2 px-4 text-sm">Tambah Ruangan</a>
                </div>
            </div>
            <div class="bg-white rounded-md p-4 mb-4">
                <div class="relative overflow-x-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        @foreach ($rooms as $room)
                        <div class="p-4">
                            <div class="bg-white shadow-md rounded-lg p-4">
                                <div class="flex flex-col">
                                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                        <a href="{{ route('inventory.index', ['building' => $building->id, 'room' => $room->id]) }}" class="text-blue-950 hover:underline">
                                            {{ $room->name }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-500 mb-4">{{ $room->number }}</p>
                                    <div class="flex space-x-4">
                                        <a href="{{ route('room.edit', [$building->id, $room->id]) }}" class="text-blue-950 hover:underline">Edit</a>
                                        <form action="{{ route('room.destroy', ['building' => $building->id, 'room' => $room->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
