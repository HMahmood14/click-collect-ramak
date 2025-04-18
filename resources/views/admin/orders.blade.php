<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Bestellingen</title>
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
            <a href="#" class="hover:underline">
                {{ session('success') }}
            </a>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-slagerij-green">Bestellingen</h2>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm max-w-full">
        <table class="min-w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klant</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-mailadres</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefoon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bestelling</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Totaal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Afhaaltijd</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($orders as $order)
                <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $order->customer->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $order->customer->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $order->customer->phone }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <ul>
                            @foreach ($order->items as $item)
                                <li>{{ $item->product->name }} ({{ $item->quantity }} kg)</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">€ {{ number_format($order->total_price, 2, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->pickup_time)->format('d-m-Y H:i') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <div class="flex flex-col gap-2">
                            <form action="#" method="POST">
                                @csrf
                                @method('PATCH')
                                <label class="inline-flex items-center cursor-pointer">
                                    <input
                                        type="checkbox"
                                        name="status"
                                        onchange="this.form.submit()"
                                        {{ $order->status === 'ready' ? 'checked' : '' }}
                                        class="sr-only peer"
                                    >
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-green-500 rounded-full peer peer-checked:bg-green-500 relative">
                                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition peer-checked:translate-x-full"></div>
                                    </div>
                                    <span class="ml-3 text-sm text-gray-700">Klaar voor afhaal</span>
                                </label>
                            </form>

                            <form action="#" method="POST">
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
