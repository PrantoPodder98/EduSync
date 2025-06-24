<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduSync - Campus Life Solution</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-900 font-sans">

    <!-- Navbar -->
    @include('frontend.layouts.header')

    @yield('content')

    <!-- Footer -->
    @include('frontend.layouts.footer')

</body>

</html>
