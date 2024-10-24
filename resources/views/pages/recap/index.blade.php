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
                    <div class="font-semibold text-lg text-gray-800 leading-tight">
                        <table class="w-full">
                            <tr>
                                <td class="pr-4">Judul Rekap</td>
                                <td>: Contoh Judul Rekap</td>
                            </tr>
                            <tr>
                                <td class="pr-4">Tanggal Rekap</td>
                                <td>: 24-10-2024</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-md p-4 mb-4">
                <div class="flex justify-between mb-3">
                    <form action="#" method="GET" class="flex items-center space-x-2 w-full md:w-auto">
                        <input type="text" name="search" placeholder="Cari Data..." class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">Cari</button>
                    </form>
                    <a href="#" class="bg-blue-950 text-white rounded-md text-sm py-2 px-3">Export Rekap</a>
                </div>
            </div>

            <div class="bg-white rounded-md p-4 mb-4">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama Barang</th>
                                <th class="px-6 py-3">Nama Ruang</th>
                                <th class="px-6 py-3">Total</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
