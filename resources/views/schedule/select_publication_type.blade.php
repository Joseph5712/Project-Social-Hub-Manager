<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Publicaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

    <div class="container mx-auto mt-12">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-semibold mb-6 text-center">Gestión de Publicaciones</h1>
            <p class="text-gray-600 text-center mb-6">
                Escoge la acción que deseas realizar.
            </p>
            
            <!-- Opciones de acción -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Enlace para Publicación Instantánea -->
                <a href="{{ route('publish.select') }}" 
                   class="block bg-blue-500 hover:bg-blue-600 text-white py-4 px-6 rounded-lg text-center">
                    <span class="font-bold text-xl">Publicación Instantánea</span>
                </a>

                <!-- Enlace para Enviar a Cola -->
                <a href="#" 
                   class="block bg-green-500 hover:bg-green-600 text-white py-4 px-6 rounded-lg text-center">
                    <span class="font-bold text-xl">Enviar a Cola</span>
                </a>

                <!-- Enlace para Publicación Programada -->
                <a href="#" 
                   class="block bg-yellow-500 hover:bg-yellow-600 text-white py-4 px-6 rounded-lg text-center">
                    <span class="font-bold text-xl">Publicación Programada</span>
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
