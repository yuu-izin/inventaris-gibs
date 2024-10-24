<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Halaman Building
                </h2>
                <div class="text-sm text-gray-500">Halaman untuk memanajemen Data Building</div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-md p-4 mb-4">
                <div class="flex justify-between items-center">
                    <form action="{{ route('building.index') }}" method="GET" class="flex items-center space-x-2 w-full md:w-auto">
                        <input type="text" name="search" placeholder="Cari Building..." value="{{ request('search') }}"
                            class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">Cari</button>
                    </form>
                    <a href="{{ route('building.create') }}" class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">
                        Tambah Data Gedung
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                @foreach ($buildings as $building)
                <div class="bg-white rounded-md shadow p-4">
                    <div class="flex items-center">
                        <img src="{{ asset('images/buildings/' . $building->image) }}" alt="{{ $building->name }}" class="object-cover w-24 h-24 rounded-md">
                        <div class="ml-4 flex-1">
                            <a href="{{ route('room.index', $building->id) }}" class="text-xl font-semibold mb-2">{{ $building->name }}</a>
                            <div class="text-sm text-gray-600">Tanggal dibuat: {{ $building->created_at }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
