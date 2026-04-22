<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @include('partials.head-assets')
    </head>
    <body class="h-full font-sans antialiased text-gray-900 dark:text-gray-100" x-data="displayPrefs()" x-init="init()">
        <div class="min-h-full bg-gray-100 transition-colors dark:bg-gray-950">
            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
                    <div
                        class="mx-auto py-6 px-4 transition-[max-width] sm:px-6 lg:px-8"
                        :class="wideLayout ? 'max-w-[1600px]' : 'max-w-7xl'"
                    >
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                <div
                    class="mx-auto px-4 transition-[max-width] sm:px-6 lg:px-8"
                    :class="wideLayout ? 'max-w-[1600px]' : 'max-w-7xl'"
                >
                    {{ $slot }}
                </div>
            </main>

            <x-display-settings />
        </div>
    </body>
</html>
