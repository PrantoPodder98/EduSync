<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduSync - Campus Life Solution</title>
    @yield('custom_css')
</head>

<body class="bg-white text-gray-900 font-sans">

    <!-- Navbar -->
    @include('frontend.layouts.header')

    @yield('content')

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('profileDropdownButton');
            const menu = document.getElementById('profileDropdownMenu');

            button.addEventListener('click', function(e) {
                e.stopPropagation(); // prevent closing immediately
                menu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!menu.contains(e.target) && !button.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>

    @yield('custom_js')

</body>

</html>
