<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $product->name }}</title>
    @vite(['resources/css/app.css'])
    <script>
        function adjustQuantityInput() {
            const typeSelect = document.getElementById('type');
            const quantityInput = document.getElementById('quantity');

            if (typeSelect.value === 'kilo') {
                quantityInput.step = 0.1;
                quantityInput.min = 0.1;
                quantityInput.value = 0.1;
            } else if (typeSelect.value === 'stuk') {
                quantityInput.step = 1;
                quantityInput.min = 1;
                quantityInput.value = 1;
            }
        }

        window.onload = adjustQuantityInput;
    </script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

@include('partials.nav')

<section class="container mx-auto py-12 flex-grow">
    @if (session('success'))
        <div id="success-message" class="bg-green-200 text-green-800 p-4 rounded mb-6 flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="document.getElementById('success-message').style.display='none'" class="ml-4 text-green-700 hover:text-green-900">&times;</button>
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-3xl font-semibold text-slagerij-green">{{ $product->name }}</h2>
        <p class="mt-4">{{ $product->description }}</p>
        <p class="mt-4 text-lg font-semibold text-slagerij-green">Prijs per kilo: € {{ number_format($product->price, 2) }}</p>

        <form action="{{ route('cart.add') }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="uuid" value="{{ $product->uuid }}">

            <div class="flex items-center space-x-6 mt-4">
                <div>
                    <label for="type" class="text-lg mr-2">Bestel per:</label>
                    <select name="type" id="type" class="border rounded px-3 py-2" required onchange="adjustQuantityInput()">
                        <option value="kilo" selected>Per kilo</option>
                        <option value="stuk">Per stuk</option>
                    </select>
                </div>

                <div>
                    <label for="quantity" class="mr-2 text-lg">Aantal:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="0.1" step="0.1" class="border rounded px-4 py-2 w-24" required>
                </div>

                <button type="submit" class="bg-slagerij-green text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-all">
                    Voeg toe aan winkelmandje
                </button>
            </div>
        </form>
    </div>
</section>

@include('partials.footer')

</body>
</html>
