<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
<div class="max-w-md w-full bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-8">Login</h2>
    <form method="POST" action="{{ route('login.perform') }}">
        @csrf
        <div class="mb-4">
            <label for="login" class="block text-gray-700 text-sm font-semibold mb-2">Login</label>
            <input type="text" id="login" name="login" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3" value="{{ old('login') }}" required autofocus>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
            <input type="password" id="password" name="password" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3" required>
        </div>
        <div class="flex justify-between items-center">
            <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Login</button>
        </div>
    </form>
</div>
</body>
</html>
