<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="min-h-full">
  <!-- Navbar -->
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <!-- Logo -->
          <div class="shrink-0">
            <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <!-- Navigation Links -->
          <div class="hidden md:flex space-x-4 ml-10">
            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-white px-3 py-2 bg-gray-900 rounded-md">Dashboard</a>
            <a href="#" class="text-sm font-medium text-gray-300 px-3 py-2 hover:bg-gray-700 hover:text-white">LinkedIn</a>
            <a href="#" class="text-sm font-medium text-gray-300 px-3 py-2 hover:bg-gray-700 hover:text-white">Pinterest</a>
          </div>
        </div>
        <!-- Logout -->
        <div>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-sm text-white bg-red-600 px-3 py-2 rounded-md hover:bg-red-500">Cerrar sesión</button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    </div>
  </header>

  <!-- Main Content -->
  <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
      <!-- LinkedIn Section -->
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Integración con LinkedIn</h2>
        <p class="text-sm text-gray-600 mb-4">Prueba la funcionalidad de LinkedIn aquí:</p>
        <a href="{{ route('linkedin.redirect') }}" class="text-white bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-500">
          Probar LinkedIn
        </a>
      </div>

      <!-- Pinterest Section -->
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Integración con Pinterest</h2>
        <p class="text-sm text-gray-600 mb-4">Prueba la funcionalidad de Pinterest aquí:</p>
        
        </a>
      </div>
    </div>
  </main>
</div>
</body>
</html>
