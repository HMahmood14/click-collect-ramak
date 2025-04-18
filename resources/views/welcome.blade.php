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
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-bold text-slagerij-green">Kip</h3>
            <img src="/images/home/kip.png" alt="Kip" class="w-full h-40 object-cover mb-4">
            <p>Vers en smaakvol kippenvlees.</p>
            <a href="#" class="text-slagerij-green hover:underline">Bekijk meer</a>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-bold text-slagerij-green">Rund</h3>
            <img src="/images/home/koe.png" alt="Rund" class="w-full h-40 object-cover mb-4">
            <p>Topkwaliteit rundvlees.</p>
            <a href="#" class="text-slagerij-green hover:underline">Bekijk meer</a>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-bold text-slagerij-green">Lams</h3>
            <img src="/images/home/lam.png" alt="Lams" class="w-full h-40 object-cover mb-4">
            <p>Heerlijke lamsproducten.</p>
            <a href="#" class="text-slagerij-green hover:underline">Bekijk meer</a>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-bold text-slagerij-green">Broodbeleg</h3>
            <img src="/images/home/beleg.png" alt="Broodbeleg" class="w-full h-40 object-cover mb-4">
            <p>Populaire broodbeleg producten zoals ham, kaas en salami.</p>
            <a href="#" class="text-slagerij-green hover:underline">Bekijk meer</a>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-bold text-slagerij-green">Hardlopers</h3>
            <img src="/images/home/snitzel.png" alt="Hardlopers" class="w-full h-40 object-cover mb-4">
            <p>Onze bestsellers die vaak besteld worden!</p>
            <a href="#" class="text-slagerij-green hover:underline">Bekijk meer</a>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-bold text-slagerij-green">Premium</h3>
            <img src="/images/home/premium.png" alt="Premium" class="w-full h-40 object-cover mb-4">
            <p>Exclusieve premium producten voor de fijnproever!</p>
            <a href="#" class="text-slagerij-green hover:underline">Bekijk meer</a>
        </div>
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
