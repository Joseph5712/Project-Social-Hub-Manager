<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuentas Conectadas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="container mx-auto mt-12">
    <div class="bg-white shadow-md rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Cuentas Conectadas</h1>

        <!-- Lista de Cuentas Conectadas -->
        @if($connectedAccounts->isEmpty())
            <p class="text-center text-gray-600">No hay cuentas conectadas.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($connectedAccounts as $account)
                    <div class="bg-gray-50 shadow rounded-lg p-4">
                        <h3 class="text-lg font-bold">{{ ucfirst($account->provider) }}</h3>
                        <p class="text-gray-600 mt-2">Conectado como: {{ $account->username ?? 'N/A' }}</p>
                        <form action="{{ route('social.disconnect', $account->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">
                                Desconectar
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Botón para volver al Dashboard -->
        <div class="mt-6 text-center">
            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">
                &larr; Volver al Dashboard
            </a>
        </div>
    </div>
</div>

</body>
</html>
