<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Admin Login</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white flex flex-col min-h-screen justify-center items-center">
<div class="w-full max-w-md bg-white border rounded-lg shadow-md p-8">
    <h2 class="text-2xl font-semibold text-slagerij-green mb-6 text-center">Admin Login</h2>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-lg text-slagerij-green">E-mailadres</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md" value="{{ old('email') }}" required autofocus>
            @error('email')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-lg text-slagerij-green">Wachtwoord</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md" required>
            @error('password')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="bg-slagerij-green text-white px-6 py-2 rounded-lg text-lg hover:bg-green-700 transition-all w-full">
                Inloggen
            </button>
        </div>
    </form>
</div>
</body>
</html>
