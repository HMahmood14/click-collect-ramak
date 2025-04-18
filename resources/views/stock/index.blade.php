<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Voorraad</title>
    @vite(['resources/css/app.css'])
    <script>
        function closeSuccessMessage() {
            var successMessage = document.getElementById('success-message');
            successMessage.style.display = 'none';
        }
    </script>
</head>
<body class="bg-white flex flex-col min-h-screen">
<div class="container mx-auto py-8">
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg mb-6 relative">
            <button onclick="closeSuccessMessage()" class="absolute top-2 right-2 text-white">
                &times;
            </button>
            <a href="{{ route('stock.index') }}" class="hover:underline">
                {{ session('success') }}
            </a>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-slagerij-green">Voorraad</h2>
        <a href="{{ route('stock.create') }}" class="bg-slagerij-green text-white px-4 py-2 rounded-lg text-lg hover:bg-green-700 transition-all">
            Voorraad Toevoegen
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm max-w-full">
        <table class="min-w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hoeveelheid (kg)</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Datum</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($stocks as $stock)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $stock->product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-semibold">{{ number_format($stock->quantity, 2, ',', '.') }} kg</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($stock->date)->format('d-m-Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                        <div class="flex space-x-4">
                            <a href="{{ route('stock.edit', $stock->id) }}" class="text-slagerij-green hover:underline">Bewerken</a>
                            <form action="{{ route('stock.delete', $stock->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Verwijderen</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
