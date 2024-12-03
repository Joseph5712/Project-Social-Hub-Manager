@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Editar Horario</h1>
    <form action="{{ route('schedules.update', $schedule) }}" method="POST" class="bg-white p-6 shadow-md rounded">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="day_of_week" class="block text-gray-700 font-bold mb-2">Día de la Semana</label>
            <select name="day_of_week" id="day_of_week" class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                <option value="L" {{ $schedule->day_of_week == 'L' ? 'selected' : '' }}>Lunes</option>
                <option value="K" {{ $schedule->day_of_week == 'K' ? 'selected' : '' }}>Martes</option>
                <option value="M" {{ $schedule->day_of_week == 'M' ? 'selected' : '' }}>Miércoles</option>
                <option value="J" {{ $schedule->day_of_week == 'J' ? 'selected' : '' }}>Jueves</option>
                <option value="V" {{ $schedule->day_of_week == 'V' ? 'selected' : '' }}>Viernes</option>
                <option value="S" {{ $schedule->day_of_week == 'S' ? 'selected' : '' }}>Sábado</option>
                <option value="D" {{ $schedule->day_of_week == 'D' ? 'selected' : '' }}>Domingo</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="time" class="block text-gray-700 font-bold mb-2">Hora</label>
            <input type="time" name="time" id="time" value="{{ $schedule->time }}" class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar</button>
    </form>
</div>
@endsection
