<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herinnering - Bestelling klaar voor afhalen</title>
</head>
<body>
<h1>Hallo {{ $order->customer->name }}</h1>
<p>Je bestelling is klaar voor afhalen!</p>

<h3>Bestellingsgegevens:</h3>
<ul>
    @foreach ($order->items as $item)
        <li>{{ $item->product->name }} - {{ $item->quantity }} kg</li>
    @endforeach
</ul>

<p>Totaal te betalen: €{{ number_format($order->total_price, 2) }}</p>
<p>Afhaaltijd: {{ \Carbon\Carbon::parse($order->pickup_time)->format('d-m-Y H:i') }}</p>

<p>We hopen je snel te zien voor de afhaling van je bestelling!</p>

<p>Met vriendelijke groet,</p>
<p>Team Ramak</p>
</body>
</html>
