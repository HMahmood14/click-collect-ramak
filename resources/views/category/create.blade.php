<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Categorie Toevoegen</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white flex flex-col min-h-screen">
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold text-slagerij-green mb-6">Categorie Toevoegen</h2>
    <form action="{{ route('category.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-lg text-slagerij-green">Naam</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name') }}" required>
            @error('name')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex space-x-4">
            <button type="submit" class="bg-slagerij-green text-white px-6 py-2 rounded-lg text-lg hover:bg-green-700 transition-all">
                Toevoegen
            </button>
            <a href="{{ route('category.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg text-lg hover:bg-gray-400 transition-all">
                Terug
            </a>
        </div>
    </form>
</div>
</body>
</html>
