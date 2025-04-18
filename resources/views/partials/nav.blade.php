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
            <li>
                <a href="{{ route('admin.login') }}" class="text-black border border-slagerij-green px-4 py-1.5 rounded-md hover:bg-slagerij-green hover:text-white transition flex items-center space-x-2">
                    <!-- Het icoon is nu standaard zwart en zal wit worden bij hover -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM12 14c-3.31 0-6 2.69-6 6h12c0-3.31-2.69-6-6-6z"/>
                    </svg>
                    <span class="text-black group-hover:text-white">Admin</span>
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
