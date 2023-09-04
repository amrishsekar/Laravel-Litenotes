<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="flex justify-between items-center bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl ml-5 py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>

                    @if (request()->routeIs('notes.index'))
                    <div>
                        {{-- Common Note Search --}}
                        <form action="{{ route('notes.index') }}" method="post" class="w-full px-5 space-y-6 flex justify-between items-center">
                            @method('get')
                            @csrf
                            <x-text-input type="text"
                            name="search"
                            field="search" 
                            placeholder="Search note here..." 
                            class="col-9 mt-2 py-2 px-4 text-gray-200 border sm:ounded-lg dark:bg-gray-900" 
                            autocomplete="off"></x-text-input>
    
                            <button class="px-6 ml-2 mr-1 btn-link btn-lg p-2 dark:bg-gray-700 shadow-lg sm:rounded-lg">Search</button>
                        </form>
                    </div>
                    @elseif(request()->routeIs('trashed.index'))
                    <div>
                        {{-- Trashed Note Search --}}
                        <form action="{{ route('trashed.index') }}" method="POST" class="w-full px-5 space-y-6 flex justify-between items-center">
                            @method('get')
                            @csrf
                            <x-text-input type="text"
                            name="search"
                            field="search" 
                            placeholder="Search trashed note here..." 
                            class="mt-2 py-2 px-4 text-gray-200 border sm:ounded-lg dark:bg-gray-900" 
                            autocomplete="off"></x-text-input>
    
                            <button class="px-6 ml-2 mr-1 btn-link btn-lg p-2 dark:bg-gray-700 shadow-lg sm:rounded-lg">Search</button>
                        </form>
                    </div>
                    @endif
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
