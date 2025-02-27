<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '7sebFlosk - Welcome')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content Area -->
    <main class="flex-1 w-full p-6">
        @include('partials.message')

        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    @vite(['resources/js/app.js'])
</body>

</html>
