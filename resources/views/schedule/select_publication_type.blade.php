<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Publicaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

    <div class="container mx-auto p-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold mb-6 text-center">Gestión de Publicaciones</h1>

            <form method="POST" class="flex justify-around space-x-4">
                <!-- Botón de Publicación Instantánea -->
                <button 
                    type="submit" 
                    name="publicacion_instantanea"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transform transition duration-300 hover:scale-105">
                    Publicación Instantánea
                </button>

                <!-- Botón de Enviar a Cola -->
                <button 
                    type="submit" 
                    name="enviar_a_cola"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transform transition duration-300 hover:scale-105">
                    Enviar a Cola
                </button>

                <!-- Botón de Publicación Programada -->
                <button 
                    type="submit" 
                    name="publicacion_programada"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transform transition duration-300 hover:scale-105">
                    Publicación Programada
                </button>
            </form>
        </div>
    </div>

</body>
</html>