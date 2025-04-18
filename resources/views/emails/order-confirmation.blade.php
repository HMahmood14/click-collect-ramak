<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bevestiging van je bestelling</title>
</head>
<body>
<h1>Bedankt voor je bestelling, {{ $order->customer->name }}!</h1>
<p>Je bestelling is succesvol geplaatst en wordt binnenkort verwerkt.</p>

<h3>Bestellingsgegevens:</h3>
<ul>
    @foreach ($order->items as $item)
        <li>{{ $item->product->name }} - {{ $item->quantity }} kg - €{{ number_format($item->price, 2) }}</li>
    @endforeach
</ul>

<p>Totaal te betalen: €{{ number_format($order->total_price, 2) }}</p>
<p>Afhaaltijd: {{ $order->pickup_time }}</p>

<h3>Herinnering:</h3>
<p>Als je de bestelling wilt annuleren, neem dan binnen 15 minuten na het plaatsen van de bestelling telefonisch contact met ons op. Na deze tijd kan de bestelling helaas niet meer geannuleerd worden.</p>

<p>Je ontvangt een herinnering per e-mail zodra je bestelling klaar is voor afhaling. Zorg ervoor dat je de e-mail goed controleert om te weten wanneer je bestelling opgehaald kan worden.</p>

<p>Met vriendelijke groet,<br>Team Ramak</p>
</body>
</html>
