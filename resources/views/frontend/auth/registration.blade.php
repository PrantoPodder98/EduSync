<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-100">
    <div class="flex min-h-screen">

        <!-- Left Side -->
        <div class="w-1/2 bg-indigo-600 text-white flex flex-col justify-center items-center p-12">
            <h1 class="text-3xl font-bold mb-4">Welcome to EduSync</h1>
            <p class="text-lg mb-8 text-center max-w-xs">
                Your complete campus ecosystem for students and businesses
            </p>
            <img src="{{ asset('asset/frontend_asset') }}/images/login-illustration.jpg" alt="Campus Illustration"
                class="rounded-lg shadow-lg w-80 h-auto">
        </div>

        <!-- Right Side (Form) -->
        <div class="w-1/2 bg-white flex items-center justify-center px-16">
            <div class="w-full max-w-md">
                <!-- Tabs -->
                <div class="flex justify-center mb-8">
                    <a href="{{ route('login') }}" class="text-gray-400 px-4 py-2 focus:outline-none">Sign In</a>

                    <a class="text-indigo-600 font-semibold border-b-2 border-indigo-600 px-4 py-2 focus:outline-none"
                        href="{{ route('register') }}">Sign Up</a>
                </div>

                @if ($errors->any())
                    <div class="text-red-500 text-sm">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- Registartion Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-600 mb-1">Name</label>
                        <input type="text" placeholder="John Doe" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required autofocus>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Email Address</label>
                        <input type="email" placeholder="your@email.com" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Password</label>
                        <input type="password" placeholder="••••••••" name="password" value="{{ old('password') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Confirm Password</label>
                        <input type="password" placeholder="••••••••" name="password_confirmation" value="{{ old('password_confirmation') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>


                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2 text-sm">
                            <input type="checkbox" class="form-checkbox text-indigo-600" name="remember"
                                {{ old('remember') ? 'checked' : '' }} id="remember_me">

                            <span>Remember me</span>
                        </label>
                        <a href="{{ route('login') }}" class="text-indigo-600 text-sm hover:underline">Already
                            registered?</a>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg">Register</button>

                </form>
            </div>
        </div>

    </div>
</body>

</html>
