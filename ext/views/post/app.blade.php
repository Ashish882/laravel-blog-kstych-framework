<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog</title>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- Styles -->
    <link href="{{ asset('custom/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
 
</head>
<body class="bg-white h-screen antialiased leading-none font-sans">

<div id="app">
        <header class="bg-indigo-600 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                      Blog
                    </a>
                </div>

                <nav class="space-x-4  text-gray-300 text-sm sm:text-base">
                    @guest
                        <a class="font-semibold no-underline hover:underline" href="/login">Login</a>
                       
                            <a class="font-semibold no-underline hover:underline" href="/register">Register</a>
                    @else
                        <span>{{ Auth::user()->fullname }}</span>
                    @endguest
                </nav>
             
            </div>
        </header>

        @yield('content')
    </div>

</body>
</html>
