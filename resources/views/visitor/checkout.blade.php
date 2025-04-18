<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling - Checkout</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

@include('partials.nav')

<section class="container mx-auto py-12">
    <h2 class="text-2xl font-bold text-center mb-6 text-slagerij-green">Checkout</h2>

    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-lg">Naam</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md" value="{{ old('name') }}" required>
                @error('name')
                <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-lg">E-mailadres</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md" value="{{ old('email') }}" required>
                @error('email')
                <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-lg">Telefoonnummer</label>
                <input type="text" name="phone" id="phone" class="w-full px-4 py-2 border rounded-md" value="{{ old('phone') }}" required>
                @error('phone')
                <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="pickup_time" class="block text-lg">Afhaaltijd</label>
                <input type="datetime-local" name="pickup_time" id="pickup_time" class="w-full px-4 py-2 border rounded-md" value="{{ old('pickup_time') }}" required>
                @error('pickup_time')
                <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <h3 class="text-xl font-semibold mt-8 text-slagerij-green">Winkelmandje</h3>
        <div class="bg-white p-4 rounded shadow mt-4">
            @foreach ($cartItems as $item)
                <div class="flex justify-between items-center">
                    <p>{{ $item['name'] }}</p>
                    <p>{{ $item['quantity'] }} x €{{ number_format($item['price'], 2) }}</p>
                </div>
            @endforeach
            <div class="mt-4 flex justify-between items-center font-semibold">
                <span>Totaal:</span>
                <span>€{{ number_format($total, 2) }}</span>
            </div>
        </div>

        <div class="mt-6 text-center">
            <button type="submit" class="bg-slagerij-green text-white px-6 py-2 rounded-lg text-lg hover:bg-green-700 transition-all">Bestelling plaatsen</button>
        </div>
    </form>
</section>

@include('partials.footer')

</body>
</html>
