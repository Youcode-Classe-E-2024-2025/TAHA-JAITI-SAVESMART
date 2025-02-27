<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '7sebFlosk - Welcome')</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content Area -->
    <main class="flex-1 w-full p-6 mt-20">
        @include('partials.message')

        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    @vite(['resources/js/app.js'])
</body>

</html>
