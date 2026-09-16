@vite(['resources/css/game.css', 'resources/js/game.js'])

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                {{ now()->format('l, d M Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome banner --}}
            <div class="relative overflow-hidden rounded-xl shadow-sm bg-gradient-to-r from-indigo-600 to-purple-600">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_right,_white,_transparent_60%)]"></div>
                <div class="relative p-8">
                    <h3 class="text-2xl font-bold text-white">
                        Welcome back, {{ Auth::user()->name ?? 'friend' }} 👋
                    </h3>
                </div>
            </div>

            {{-- Quick links navbar --}}
            <nav class="bg-white dark:bg-gray-800 rounded-xl shadow-sm px-4 py-3">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('profile.edit') }}"
                       class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">
                        Edit Profile
                    </a>
                    <a href="#"
                       class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium transition">
                        Order History
                    </a>
                    <a href="#"
                       class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium transition">
                        Account Settings
                    </a>
                    <a href="#"
                       class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium transition">
                        Contact Support
                    </a>
                </div>
            </nav>

        </div>
    </div>
</x-app-layout>