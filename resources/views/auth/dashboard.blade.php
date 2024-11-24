<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 bg-blue-600 h-screen text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Social Hub Manager</h1>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-blue-700">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-blue-700">Publicar Entrada</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-blue-700">Horarios</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-blue-700">Cola de Publicaciones</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left py-2 px-4 hover:bg-blue-700">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-4">Bienvenido, {{ Auth::user()->name }}</h2>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-xl font-bold">Redes Sociales Conectadas</h3>
                    <p class="text-2xl mt-4">2</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-xl font-bold">Entradas Publicadas</h3>
                    <p class="text-2xl mt-4">15</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-xl font-bold">Publicaciones en Cola</h3>
                    <p class="text-2xl mt-4">5</p>
                </div>
            </div>

            <!-- Actions Section -->
            <div class="mt-8">
                <h3 class="text-2xl font-bold mb-4">Acciones Rápidas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{ route('publish') }}" class="block bg-green-500 hover:bg-green-600 text-white py-4 px-6 rounded-lg text-center">
                        <span class="font-bold text-xl">Publicar Entrada</span>
                    </a>
                    <a href="#" class="block bg-yellow-500 hover:bg-yellow-600 text-white py-4 px-6 rounded-lg text-center">
                        <span class="font-bold text-xl">Configurar Horarios</span>
                    </a>
                    <a href="#" class="block bg-red-500 hover:bg-red-600 text-white py-4 px-6 rounded-lg text-center">
                        <span class="font-bold text-xl">Revisar Cola</span>
                    </a>
                </div>
            </div>

            <!-- Twitter Connection Section -->
            <div class="mt-8">
                <h3 class="text-2xl font-bold mb-4">Conectar con Twitter</h3>
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <p class="mb-4 text-gray-600">
                        Conecta tu cuenta de Twitter para comenzar a publicar directamente desde esta aplicación.
                    </p>
                    <a href="{{ route('twitter.redirect') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                        Conectar con Twitter
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
