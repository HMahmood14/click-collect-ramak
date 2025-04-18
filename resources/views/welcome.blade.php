<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Click & Collect</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white flex flex-col min-h-screen">

@include('partials.nav')

<header class="h-96 bg-cover bg-center flex items-center justify-center text-black" style="background-image: url('https://source.unsplash.com/1600x900/?meat')">
    <div class="text-center">
        <h2 class="text-4xl font-bold text-slagerij-green">Topkwaliteit, eerlijk vlees, direct voor jou bereid!</h2>
        <p class="mt-2 text-black">Bestel nu en haal je bestelling af in onze winkel.</p>
        <a href="/bestellen" class="bg-slagerij-green text-white py-2 px-6 rounded-lg text-xl font-semibold hover:bg-green-700 transition-all mt-4 inline-block">Bestel nu</a>
    </div>
</header>

<section id="assortiment" class="container mx-auto py-12">
    <h2 class="text-2xl font-bold text-center mb-6 text-slagerij-green">Ons Assortiment</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4">
        @foreach ($categories as $category)
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-xl font-bold text-slagerij-green">{{ $category->name }}</h3>
                <a href="#" class="text-slagerij-green hover:underline">Bekijk producten</a>
            </div>
        @endforeach
    </div>
</section>

<section id="reviews" class="py-12 bg-gray-100">
    <h2 class="text-center text-2xl font-bold text-slagerij-green mb-6">Reviews</h2>
    <div class="flex justify-center space-x-4 flex-wrap gap-4 px-4">
        <div class="bg-white p-6 rounded-lg shadow-md max-w-sm">
            <p class="text-lg italic">"Geweldige kwaliteit vlees! Zeker voor herhaling vatbaar."</p>
            <p class="text-right font-bold">– Jan de Vries</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md max-w-sm">
            <p class="text-lg italic">"Eenvoudig te bestellen, snel geleverd, en altijd vers."</p>
            <p class="text-right font-bold">– Anja de Boer</p>
        </div>
    </div>
</section>

@include('partials.footer')
</body>
</html>
