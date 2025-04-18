<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Product Bewerken</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white flex flex-col min-h-screen">
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold text-slagerij-green mb-6">Product Bewerken</h2>
    <form action="{{ route('product.update', $product->uuid) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-lg text-slagerij-green">Naam</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name', $product->name) }}" required>
            @error('name')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-lg text-slagerij-green">Beschrijving</label>
            <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-md" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-lg text-slagerij-green">Prijs (€)</label>
            <input type="number" step="0.01" name="price" id="price" class="w-full px-4 py-2 border rounded-md" value="{{ old('price', $product->price) }}" required>            @error('price')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block text-lg text-slagerij-green">Categorie</label>
            <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded-md" required>
                <option value="" disabled selected>Kies een categorie</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-slagerij-green text-white px-6 py-2 rounded-lg text-lg hover:bg-green-700 transition-all">
                Bewerken
            </button>
            <a href="{{ route('product.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg text-lg hover:bg-gray-400 transition-all">
                Terug
            </a>
        </div>
    </form>
</div>
</body>
</html>
