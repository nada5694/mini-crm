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
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex min-h-[calc(100vh-64px)]">
                 <!-- Sidebar -->
                <aside class="w-64 bg-white border-r border-gray-200 shadow-md flex flex-col">
                    <div class="p-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800">Mini CRM</h2>
                    </div>
                    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                        <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-300 font-semibold' : '' }}">
                            الصفحة الرئيسية
                        </a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('users.index') }}"
                            class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-200 {{ request()->routeIs('employees.*') ? 'bg-gray-300 font-semibold' : '' }}">
                                الموظفين
                            </a>
                        @endif
                        <a href="{{ route('customers.index') }}"
                        class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-200 {{ request()->routeIs('customers.*') ? 'bg-gray-300 font-semibold' : '' }}">
                            العملاء
                        </a>
                        <a href="{{ route('actions.index') }}"
                        class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-200 {{ request()->routeIs('actions.*') ? 'bg-gray-300 font-semibold' : '' }}">
                            الإجراءات
                        </a>
                        <a href="{{ route('profile.edit') }}"
                        class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-200 {{ request()->routeIs('profile.edit') ? 'bg-gray-300 font-semibold' : '' }}">
                            حسابي
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-red-600 hover:bg-red-100">
                                تسجيل خروج
                            </button>
                        </form>
                    </nav>
                </aside>
                @yield('content')
            </main>
        </div>
    </body>
</html>
