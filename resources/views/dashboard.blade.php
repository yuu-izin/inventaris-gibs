<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <!-- Image -->
            <img src="{{ asset('img/imgs/logo.2.png') }}" alt="Logo" class="h-10 w-10 mr-4">

            <!-- Dashboard Title -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }} <br>
                <div class="text-sm text-[#404040]">
                {{ __("Akses menu dan informasi penting lainnya di sini") }}
                </div>

            </h2>
        </div>
    </x-slot>
</x-app-layout>
