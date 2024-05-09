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
        <script src="https://kit.fontawesome.com/26f98c9e6d.js" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @auth
                @if (isset($slot))
                     {{ $slot }}
                
                @endif
                @endauth
                @yield('content')
            </main>
            {{-- <main>
                @auth
                @yield('content')
                @endauth
            </main> --}}
            <footer class="bg-gray-800 py-20 mt-20">
                <h2 class="text-center text-3xl font-bold text-gray-100 mb-10">Travel All World</h2>
            
                <nav class="container mx-auto flex flex-wrap justify-center mb-10 footer-nav-links">
                    <a href="/" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Home</a>
                    <a href="/blog" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Blog</a>
                    <a href="/login" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Login</a>
                    <a href="/register" class="text-lg font-bold text-gray-100 hover:text-gray-200">Register</a>
                </nav>
            
                <div class="container mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-bold text-gray-100 mb-4">
                            About Us
                        </h3>
            
                        <p class="text-sm text-gray-400 mb-4">
                            Travel All World is your ultimate destination for travel inspiration, tips, and guides. Explore the world with us and discover new adventures!
                        </p>
            
                        <!-- Social Media Links -->
                        <div class="flex items-center">
                            <a href="#" class="text-gray-400 hover:text-gray-200 mr-4"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-gray-400 hover:text-gray-200 mr-4"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-400 hover:text-gray-200 mr-4"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-gray-400 hover:text-gray-200"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
            
                    <!-- Lego Photo in the middle -->
                    <div class="flex justify-center items-center">
                        <img src="https://images.squarespace-cdn.com/content/v1/5a05c7feedaed85978bb9947/ac3caaf7-743e-48c9-b8bb-487f60de2d53/AWJ_Logo_RGB_WHT.png?format=1500w" alt="Lego Photo" class="h-24">
                    </div>
            
                    <!-- Quick Links on the right -->
                    <div class="text-right">
                        <h3 class="text-lg font-bold text-gray-100 mb-4">
                            Quick Links
                        </h3>
            
                        <ul class="text-sm text-gray-400">
                            <li class="mb-2">
                                <a href="/" class="hover:text-gray-200">Home</a>
                            </li>
                            <li class="mb-2">
                                <a href="/map" class="hover:text-gray-200">Map</a>
                            </li>
                            <li class="mb-2">
                                <a href="/picturescollection" class="hover:text-gray-200">City Gallery</a>
                            </li>
                            <li class="mb-2">
                                <a href="/about" class="hover:text-gray-200">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="text-center text-xs text-gray-100 mt-10">
                    &copy 2017-2021 Travel All World. All Rights Reserved
                </p>
            </footer>
        </div>
    </body>
</html>