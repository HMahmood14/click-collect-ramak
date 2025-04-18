<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex min-h-screen">

<aside class="w-64 bg-slagerij-green text-white shadow-md p-6 space-y-6 sticky top-0 h-screen">
    <h1 class="text-2xl font-bold">Admin</h1>
    <nav class="space-y-4 text-sm font-medium">
        <a href="{{ route('category.index') }}" class="block hover:text-white text-white/90 transition">Categorieën</a>
        <a href="{{ route('product.index') }}" class="block hover:text-white text-white/90 transition">Producten</a>
        <a href="{{route('admin.orders')}}" class="block hover:text-white text-white/90 transition">Bestellingen</a>
    </nav>

    <div class="mt-auto fixed bottom-6 left-0 w-64">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-sm text-slagerij-green hover:underline bg-white px-4 py-2 rounded shadow w-full">
                Uitloggen
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 p-8">
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-slagerij-green">
            Welkom, {{ auth('admin')->user()->name }}!
        </h2>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-semibold text-slagerij-green mb-4">Recente Activiteit</h3>
        <p class="text-gray-600">Bekijk hier de laatste activiteiten en updates.</p>
    </div>
</main>
</body>
</html>
