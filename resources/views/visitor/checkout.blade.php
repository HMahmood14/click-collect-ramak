<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling - Checkout</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body class="bg-gray-100">

@include('partials.nav')

<section class="container mx-auto py-12 flex-grow">
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-6 flex justify-between items-center" id="success-alert">
            {{ session('success') }}
            <button onclick="document.getElementById('success-alert').remove()" class="text-green-800 font-bold ml-4">&times;</button>
        </div>
    @elseif(session('error'))
        <div class="bg-red-200 text-red-800 p-4 rounded mb-6 flex justify-between items-center" id="error-alert">
            {{ session('error') }}
            <button onclick="document.getElementById('error-alert').remove()" class="text-red-800 font-bold ml-4">&times;</button>
        </div>
    @endif

    <h2 class="text-2xl font-bold text-center mb-6 text-slagerij-green">Checkout</h2>

    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-lg">Naam</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name') }}" required>
                @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="email" class="block text-lg">E-mailadres</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md" value="{{ old('email') }}" required>
                @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="phone" class="block text-lg">Telefoonnummer</label>
                <input type="text" name="phone" id="phone" class="w-full px-4 py-2 border rounded-md" value="{{ old('phone') }}" required>
                @error('phone') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="pickup_time" class="block text-lg">Afhaaltijd</label>
                <input type="datetime-local" name="pickup_time" id="pickup_time" class="w-full px-4 py-2 border rounded-md" value="{{ old('pickup_time') }}" required>
                @error('pickup_time') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="mt-6 flex flex-col md:flex-row justify-center items-center gap-4">
            <button type="submit" class="bg-slagerij-green text-white px-6 py-2 rounded-lg text-lg hover:bg-green-700 transition-all">
                Bestelling plaatsen
            </button>
        </div>
    </form>
    <h3 class="text-xl font-semibold mt-8 text-slagerij-green">Winkelmandje</h3>
    <div class="bg-white p-4 rounded shadow mt-4 space-y-4">
        @forelse ($cartItems as $item)
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4">
                <div>
                    <p class="font-medium">{{ $item['name'] }} ({{ $item['quantity'] }} kg)</p>
                    <p class="text-sm text-gray-600">Prijs per kg: €{{ number_format($item['price'], 2) }}</p>
                    <p class="text-sm font-semibold text-slagerij-green">Totaal: €{{ number_format($item['quantity'] * $item['price'], 2) }}</p>
                </div>
                <form action="{{ route('cart.remove', ['uuid' => $item['uuid']]) }}" method="POST" class="mt-2 md:mt-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Verwijder</button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">Je winkelmandje is leeg.</p>
        @endforelse

        @if(count($cartItems))
            <div class="mt-4 flex justify-between items-center font-semibold">
                <span>Totaal:</span>
                <span>€{{ number_format($total, 2) }}</span>
            </div>
        @endif
    </div>
    <form action="{{ route('cart.clear') }}" method="POST" class="inline-block mt-4">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg text-lg hover:bg-red-700 transition-all">
            Verwijder alles uit winkelmandje
        </button>
    </form>
</section>
@include('partials.footer')
</body>
</html>
