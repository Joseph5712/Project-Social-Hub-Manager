<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activar 2FA</title>
    <!-- Incluye Tailwind CSS si lo deseas -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Configurar 2FA</h1>
        <p class="mb-4 text-center">Escanea este código QR con Google Authenticator:</p>
        <div class="flex justify-center mb-4">
            @if($QRImage)
                <img src="{{ $QRImage }}" alt="QR Code" class="w-48 h-48">
            @else
                <p>No se pudo generar el código QR.</p>
            @endif
        </div>
        <p class="text-center mb-6">O usa esta clave manual: <strong>{{ $secret }}</strong></p>

        <form action="{{ route('verify2fa') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="otp" class="block text-sm font-medium text-gray-700">Ingresa el código OTP:</label>
                <input type="text" name="otp" id="otp" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm">
            </div>
            <button type="submit"
                class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 font-medium">
                Verificar
            </button>
        </form>
    </div>

</body>
</html>
