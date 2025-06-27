<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduSync - Campus Life Solution</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    
    <style>
          .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 40px 0 20px;
            gap: 10px;
        }

        .pagination button {
            padding: 8px 14px;
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        .pagination button.active {
            background-color: #5d5fef;
            color: white;
            border: none;
        }

        .pagination button:disabled {
            background-color: #eee;
            color: #aaa;
            cursor: not-allowed;
        }
        @keyframes slide-in {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in 0.5s ease-out forwards;
        }
    </style>
    @yield('custom_css')
</head>

<body class="bg-white text-gray-900 font-sans">

    <!-- Navbar -->
    @include('frontend.layouts.header')

    @yield('content')

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <div id="toast-container" class="fixed top-5 right-5 z-50 space-y-4"></div>

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

    <script>
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');

            const bgColors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500',
                warning: 'bg-yellow-500 text-black'
            };

            const toast = document.createElement('div');
            toast.className = `text-white px-4 py-3 rounded shadow-md ${bgColors[type]} animate-slide-in`;
            toast.innerHTML = `
            <div class="flex items-center justify-between">
                <span>${message}</span>
                <button class="ml-4 font-bold text-white hover:text-gray-200" onclick="this.parentElement.parentElement.remove()">×</button>
            </div>
        `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 4000);
        }

        // Show multiple errors if present
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors && $errors->any())
                @foreach ($errors->all() as $error)
                    showToast(@json($error), 'error');
                @endforeach
            @endif
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showToast(@json(session('success')), 'success');
            @endif
            @if (session('error'))
                showToast(@json(session('error')), 'error');
            @endif
            @if (session('info'))
                showToast(@json(session('info')), 'info');
            @endif
            @if (session('warning'))
                showToast(@json(session('warning')), 'warning');
            @endif
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    @yield('custom_js')

</body>

</html>
