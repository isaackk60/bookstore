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
            <footer class="mt-20 footerBg">
                <div class="shrink-0 flex items-center flex-col footerImg">
                    <a href="{{ url('/') }}">
                        <img src="{{ URL('/imageFolder/logoNoBg.png') }}" class="block h-44 w-auto fill-current text-gray-800 navlogo"alt="">
                    </a >
                </div>
                {{-- <h2 class="text-center text-3xl font-bold text-gray-100 mb-10">ABout Book Shop</h2> --}}
            
                {{-- <nav class="container mx-auto flex flex-wrap justify-center mb-10 footer-nav-links">
                    <a href="/" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Home</a>
                    <a href="/book" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Catalog</a>
                    <a href="/login" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Login</a>
                    <a href="/register" class="text-lg font-bold text-gray-100 hover:text-gray-200">Register</a>
                </nav> --}}
            
                <div class="container mx-auto">
                    <div>
                        <h3 class="text-xl font-bold text-gray-100 mb-4">
                            About Our Bookstore
                        </h3>
                        <p class="text-sm text-gray-400 mb-4">
                            Book Store is the premier destination for book lovers in the Ireland, offering an extensive selection of books and stationery at unbeatable prices. Known for our curated collections and knowledgeable staff, we provide a haven for readers and writers alike.
                        </p>
                        <div class="text-xl font-bold text-gray-100 mb-4">
                            <h3>Keep In Touch</h3>
                            <ul>
                                <li class="text-sm text-gray-400 ">Mail us: <a href="mailto:D00234545@student.dkit.ie">Kim Fui leung</a></li>
                                <li class="text-sm text-gray-400 mb-4">Mail us: <a href="mailto:D00251825@student.dkit.ie">Jianfeng Han</a></li>
                                <li class="text-sm text-gray-400 mb-4">Book Store Address: Institute of Technology, Dublin Rd, Marshes Upper, Dundalk, Co. Louth, A91 K584</li>
                            </ul>
                        </div>
                    
            
                        <!-- Social Media Links -->
                        
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-100 mb-4">
                            Featured Books
                        </h3>
                        <ul class="space-y-2">
                            <li class="text-sm text-gray-400 hover:text-gray-200">
                                <a href="/book/the-great-gatsby">The Great Gatsby - F. Scott Fitzgerald</a>
                            </li>
                            <li class="text-sm text-gray-400 hover:text-gray-200">
                                <a href="/book/1984">1984 - George Orwell</a>
                            </li>
                            <li class="text-sm text-gray-400 hover:text-gray-200">
                                <a href="/book/to-kill-a-mockingbird">To Kill a Mockingbird - Harper Lee</a>
                            </li>
                        </ul>
                    </div>
            
            
                    <!-- Quick Links on the right -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-100 mb-4">
                            Quick Links
                        </h3>
            
                        <ul class="text-sm text-gray-400">
                            <li class="mb-2">
                                <a href="/" class="hover:text-gray-200">Home</a>
                            </li>
                            <li class="mb-2">
                                <a href="/reviews" class="hover:text-gray-200">Book Reviews</a>
                            </li>
                            <li class="mb-2">
                                <a href="/authors" class="hover:text-gray-200">Meet the Authors</a>
                            </li>
                            <li class="mb-2">
                                <a href="/events" class="hover:text-gray-200">Events</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="text-center text-xs text-gray-100 mt-10">
                    &copy 2017-2021 Explore Our Books. All Rights Reserved
                </p>
            </footer>
            
        </div>
    </body>
</html>