<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Entrada</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="container mx-auto mt-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Publicar en Twitter</h2>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mensaje de error -->
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('twitter.publish') }}" method="POST">
            @csrf
            <textarea name="content" rows="4" placeholder="Escribe tu publicación aquí..."
                class="w-full p-3 border border-gray-300 rounded-lg"></textarea>
            <button type="submit"
                class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                Publicar en Twitter
            </button>
        </form>
    </div>
</div>



    <!-- Back Button -->
    <div class="container mx-auto mt-4">
        <a href="{{ route('dashboard') }}" 
           class="text-blue-500 hover:underline">
            &larr; Volver al Dashboard
        </a>
    </div>

</body>
</html>
