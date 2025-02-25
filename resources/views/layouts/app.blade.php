<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '7sebFlosk')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax.bootstrapcdn.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="overflow-x-hidden bg-gray-100 text-gray-900 flex flex-col min-h-screen">
<header>
    @include('partials.header')
</header>
<main class="flex-1 p-4 px-16 flex-col w-screen">
    @yield('content')
</main>
<footer>
    @include('partials.footer')
</footer>
</body>
</html>
