<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Red Social</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto mt-12">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-bold mb-6 text-center">Selecciona una Red Social</h1>
            <p class="text-gray-600 text-center mb-6">
                Escoge la red social en la que deseas publicar tu entrada.
            </p>
            
            <!-- Opciones de redes sociales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Botón para publicar en Twitter -->
                <a href="{{ route('publish.twitter') }}" 
                   class="block bg-blue-500 hover:bg-blue-600 text-white py-4 px-6 rounded-lg text-center">
                    <span class="font-bold text-xl">Publicar en Twitter</span>
                </a>

                <!-- Botón para publicar en Mastodon -->
                <a href="{{ route('publish.mastodon') }}" 
                   class="block bg-green-500 hover:bg-green-600 text-white py-4 px-6 rounded-lg text-center">
                    <span class="font-bold text-xl">Publicar en Mastodon</span>
                </a>
            </div>

            <!-- Botón para regresar al Dashboard -->
            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}" 
                   class="text-blue-500 hover:underline">
                    &larr; Volver al Dashboard
                </a>
            </div>
        </div>
    </div>

</body>
</html>
