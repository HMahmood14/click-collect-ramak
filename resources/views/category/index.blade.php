<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramak Slagerij - Categorieën</title>
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
            <a href="{{ route('category.index') }}" class="hover:underline">
                {{ session('success') }}
            </a>
        </div>
    @endif
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-slagerij-green">Categorieën</h2>
        <a href="/admin/create/category" class="bg-slagerij-green text-white px-4 py-2 rounded-lg text-lg hover:bg-green-700 transition-all">
            Categorie Toevoegen
        </a>
    </div>
            <ul class="space-y-4">
        @foreach ($categories as $category)
            <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-slagerij-green">{{ $category->name }}</h3>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('category.edit', $category->uuid) }}" class="text-slagerij-green hover:underline">Bewerken</a>
                    <form action="{{ route('category.delete', $category->uuid) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Verwijderen</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
