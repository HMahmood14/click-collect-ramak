<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Assortiment</title>
    @vite(['resources/css/app.css'])
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.getElementById("dropdownDefaultButton");
            const dropdownMenu = document.getElementById("dropdown");
            const menuToggle = document.getElementById("menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");

            toggleButton.addEventListener("click", function() {
                dropdownMenu.classList.toggle("hidden");
            });

            document.addEventListener("click", function(event) {
                if (!toggleButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });

            menuToggle.addEventListener("click", function() {
                mobileMenu.classList.toggle("hidden");
            });
        });
    </script>
</head>
<body class="bg-gray-100">
<nav class="bg-slagerij-green p-4 text-black">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Ramak Slagerij</h1>
        <button id="menu-toggle" class="block md:hidden text-black focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        <ul class="hidden md:flex gap-6 items-center text-sm font-medium">
            <li><a href="/" class="hover:text-slagerij-black py-2">Home</a></li>
            <li class="relative">
                <button id="dropdownDefaultButton" class="text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                    Assortiment
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 absolute">
                    <ul class="py-2 text-sm text-gray-700">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Kip</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Rund</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Lams</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Broodbeleg</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Hardlopers</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Premium</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="/contact" class="hover:text-slagerij-black py-2">Contact</a></li>
            <li class="relative">
                <a href="/winkelwagen" class="hover:text-slagerij-black flex items-center relative py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </a>
            </li>
        </ul>
    </div>
    <div id="mobile-menu" class="hidden md:hidden flex flex-col bg-slagerij-green p-4">
        <a href="/" class="py-2 hover:text-slagerij-black">Home</a>
        <button id="dropdownMobileButton" class="py-2 flex justify-between w-full text-left hover:text-slagerij-black">
            Assortiment
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
        <div id="dropdownMobile" class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-full">
            <ul class="py-2 text-sm text-gray-700">
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Kip</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Rund</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Lams</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Broodbeleg</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Hardlopers</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Premium</a></li>
            </ul>
        </div>
        <a href="/contact" class="py-2 hover:text-slagerij-black">Contact</a>
        <a href="/winkelwagen" class="py-2 hover:text-slagerij-black flex items-center relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </a>
    </div>
</nav>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownMobileButton = document.getElementById("dropdownMobileButton");
        const dropdownMobile = document.getElementById("dropdownMobile");

        dropdownMobileButton.addEventListener("click", function() {
            dropdownMobile.classList.toggle("hidden");
        });

        document.addEventListener("click", function(event) {
            if (!dropdownMobileButton.contains(event.target) && !dropdownMobile.contains(event.target)) {
                dropdownMobile.classList.add("hidden");
            }
        });
    });
</script>
</body>
</html>
