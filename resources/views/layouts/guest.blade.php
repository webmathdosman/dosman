<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @include('partials.head-assets')
    </head>
    <body class="h-full font-sans text-gray-900 antialiased dark:text-gray-100" x-data="displayPrefs()" x-init="init()">
        <div class="flex min-h-full flex-col items-center bg-gray-100 pt-6 transition-colors dark:bg-gray-950 sm:justify-center sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="h-20 w-20 fill-current text-gray-500 dark:text-gray-400" />
                </a>
            </div>

            <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md dark:bg-gray-900 dark:ring-1 dark:ring-gray-700 sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>

            <x-display-settings />
        </div>
    </body>
</html>
