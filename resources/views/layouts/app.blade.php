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
                    <img src="{{ URL('/imageFolder/logoNoBg.png') }}"
                        class="block h-44 w-auto fill-current text-gray-800 navlogo"alt="">
                </a>
            </div>
            {{-- <h2 class="text-center text-3xl font-bold text-gray-100 mb-10">ABout Book Shop</h2> --}}

            {{-- <nav class="container mx-auto flex flex-wrap justify-center mb-10 footer-nav-links">
                    <a href="/" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Home</a>
                    <a href="/book" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Catalog</a>
                    <a href="/login" class="mr-5 text-lg font-bold text-gray-100 hover:text-gray-200">Login</a>
                    <a href="/register" class="text-lg font-bold text-gray-100 hover:text-gray-200">Register</a>
                </nav> --}}

            <div class="container mx-auto gap-8">
                <div>
                    <h3 class="text-xl font-bold text-lime-600 mb-4">
                        About Our Bookstore
                    </h3>
                    <p class="text-sm text-stone-900 mb-4">
                        Book Store is the premier destination for book lovers in the Ireland, offering an extensive
                        selection of books and stationery at unbeatable prices. Known for our curated collections and
                        knowledgeable staff, we provide a haven for readers and writers alike.
                    </p>
                    <div class="text-xl font-bold text-gray-100 mb-4">
                        <h3 class="mb-4">Keep In Touch</h3>
                        <ul>
                            <li class="text-sm text-gray-400 ">Mail us: <a href="mailto:D00234545@student.dkit.ie">Kim
                                    Fui Leung</a></li>
                            <li class="text-sm text-gray-400 mb-4">Mail us: <a
                                    href="mailto:D00251825@student.dkit.ie">Jianfeng Han</a></li>
                            <li class="text-sm text-gray-400 mb-4">Book Store Address: Institute of Technology, Dublin
                                Rd, Marshes Upper, Dundalk, Co. Louth, A91 K584</li>
                        </ul>
                    </div>

                </div>


                <!-- Quick Links on the right -->
                <div class="text-center">
                    <h3 class="text-lg font-bold text-gray-100 mb-4">
                        Quick Links
                    </h3>
                    <ul class="text-sm text-gray-400">
                        @guest
                            <li class="mb-2">
                                <a href="/login" class="hover:text-gray-200">Log In</a>
                            </li>
                            <li class="mb-2">
                                <a href="/register" class="hover:text-gray-200">Register</a>
                            </li>
                            <li class="mb-2">
                                <a href="/" class="hover:text-gray-200">Home</a>
                            </li>
                        @else
                            <li class="mb-2">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="hover:text-gray-200">
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                        <li class="mb-2">
                            <a href="/book" class="hover:text-gray-200">Books</a>
                        </li>

                        @auth
                            <li class="mb-2">
                                <a href="/sales" class="hover:text-gray-200">Orders</a>
                            </li>
                            <li class="mb-2">
                                <a href="/cart" class="hover:text-gray-200">Cart</a>
                            </li>
                            @if (Auth::user()->isAdmin())
                                <li class="mb-2">
                                    <a href="/userinfo" class="hover:text-gray-200">User Details</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg text-center font-bold text-gray-100 mb-4">
                        Social Media
                    </h3>

                    <div class='sm:grid grid-cols-4 pt-10 pb-16 m-auto text-center text-3xl'>
                        <div>
                            <a href="#">
                                <i class="fab fa-facebook-square text-gray-100"></i>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <i class="fab fa-instagram-square text-gray-100"></i>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <i class="fab fa-pinterest-square text-gray-100"></i>
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <i class="fab fa-youtube-square text-gray-100"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <p class="text-center text-xs text-gray-100 mt-10">
                &copy 2017-2021 Explore Our Books. All Rights Reserved
            </p>
        </footer>

    </div>
</body>

</html>
