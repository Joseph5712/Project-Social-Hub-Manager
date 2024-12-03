<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios de Publicación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Horarios de Publicación</h1>
        <a href="{{ route('schedules.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear Nuevo Horario</a>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full mt-6 bg-white shadow-md rounded border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Día</th>
                    <th class="px-4 py-2">Hora</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $schedule->day_of_week }}</td>
                        <td class="px-4 py-2">{{ $schedule->time }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('schedules.edit', $schedule) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Editar</a>
                            <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
