<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md text-white">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if (session('error'))
            <div class="mb-4 text-red-400">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block mb-1 text-sm">Email</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-6">
                <label for="password" class="block mb-1 text-sm">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 rounded font-semibold transition duration-200">
                Login
            </button>
        </form>
    </div>

</body>
</html>
