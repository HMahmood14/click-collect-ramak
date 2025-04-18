<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - Producten</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100">

@include('partials.nav')

<main>
    <section class="container mx-auto py-12">
        <h2 class="text-2xl font-bold text-center mb-6 text-slagerij-green">Producten in de categorie: {{ $category->name }}</h2>
        <p class="text-center mt-6 text-lg">
            Bekijk <a href="{{ route('home') }}" class="text-slagerij-green hover:underline">al onze categorieën</a>.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4">
            @foreach ($products as $product)
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-xl font-bold text-slagerij-green">{{ $product->name }}</h3>
                    <p>{{ $product->description }}</p>
                    <p class="text-lg font-semibold text-slagerij-green">€ {{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('product.show', ['uuid' => $product->uuid]) }}" class="text-slagerij-green hover:underline mt-4 inline-block">Bestel</a>
                </div>
            @endforeach
        </div>
    </section>
</main>

@include('partials.footer')

</body>
</html>
