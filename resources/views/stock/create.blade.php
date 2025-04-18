<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Voorraad Toevoegen</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white flex flex-col min-h-screen">
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold text-slagerij-green mb-6">Voorraad Toevoegen</h2>

    <form action="{{ route('stock.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="product_id" class="block text-lg text-slagerij-green">Product</label>
            <select name="product_id" id="product_id" class="w-full px-4 py-2 border rounded-md" required>
                <option value="">-- Kies een product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="quantity" class="block text-lg text-slagerij-green">Hoeveelheid (in kg)</label>
            <div class="flex items-center space-x-2">
                <input type="number" name="quantity" id="quantity" class="w-full px-4 py-2 border rounded-md" value="{{ old('quantity') }}" required min="0" step="0.01">
                <span class="text-gray-600"></span>
            </div>
            @error('quantity')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="date" class="block text-lg text-slagerij-green">Datum</label>
            <input type="date" name="date" id="date" class="w-full px-4 py-2 border rounded-md" value="{{ old('date', now()->toDateString()) }}">
            @error('date')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-slagerij-green text-white px-6 py-2 rounded-lg text-lg hover:bg-green-700 transition-all">
                Toevoegen
            </button>
            <a href="{{ route('stock.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg text-lg hover:bg-gray-400 transition-all">
                Terug
            </a>
        </div>
    </form>
</div>
</body>
</html>
