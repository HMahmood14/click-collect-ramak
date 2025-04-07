<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha384-Ss52p0JIQ25hs+2F7KhNOXeFwaUtD0LUxZHZPQA+2M1O3ylGQyiwHBrW8FBBAYq0" crossorigin=""/>
    <title>Ramak Slagerij - Contact</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">
@include('partials.nav')

<section id="contact" class="container mx-auto py-12 px-4">
    <h2 class="text-3xl font-bold text-center text-slagerij-green mb-8">Neem Contact Op</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4 text-slagerij-green">Onze Locatie</h3>
            <p class="text-gray-700"><strong>Adres:</strong> Oude Kustlijn 115, 2496 SK Den Haag</p>
            <p class="text-gray-700"><strong>Telefoon:</strong> <a href="tel:+31703316229" class="text-slagerij-green">070 331 6229</a></p>
            <p class="text-gray-700"><strong>Email:</strong> <a href="mailto:info@slagerijramak.nl" class="text-slagerij-green">info@slagerijramak.nl</a></p>
            <div class="mt-6">
                <iframe class="w-full h-64 rounded-lg shadow"
                        src="https://www.google.com/maps/embed/v1/place?q=Oude+Kustlijn+115,+2496+SK+Den+Haag&key=YOUR_GOOGLE_MAPS_API_KEY"
                        allowfullscreen>
                </iframe>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4 text-slagerij-green">Stel je vraag</h3>
            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700 font-medium">Naam</label>
                    <input type="text" id="name" name="name" required class="w-full p-2 border rounded-lg">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-medium">E-mail</label>
                    <input type="email" id="email" name="email" required class="w-full p-2 border rounded-lg">
                </div>

                <div>
                    <label for="message" class="block text-gray-700 font-medium">Bericht</label>
                    <textarea id="message" name="message" rows="4" required class="w-full p-2 border rounded-lg"></textarea>
                </div>

                <button type="submit" class="w-full bg-slagerij-green text-white p-3 rounded-lg hover:bg-black-700 transition">
                    Verstuur Bericht
                </button>
            </form>
        </div>
    </div>
</section>
@include('partials.footer')
</body>
</html>
