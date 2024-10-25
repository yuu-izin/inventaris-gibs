<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Halaman User
        </h2>
        <div class="text-sm text-gray-500">Halaman untuk memanajemen Data user</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-md p-4 mb-4">
                <div class="flex justify-between mb-3">
                    <div class="mb-2 font-bold">Data User</div>
                    <a href="{{ route('officer.create') }}" class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">Tambah Data User</a>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Telepon</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Tanggal Dibuat</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($officers as $officer)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ $officer->name }}
                                    </th>
                                    <td class="px-6 py-4">{{ $officer->telepon }}</td>
                                    <td class="px-6 py-4">{{ $officer->email }}</td>
                                    <td class="px-6 py-4">{{ $officer->created_at }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('officer.edit', $officer->id) }}" class="text-blue-950 hover:underline">Edit</a>
                                        <form action="{{ route('officer.destroy', $officer->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
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
