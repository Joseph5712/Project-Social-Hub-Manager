@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Crear Nuevo Horario</h1>
    <form action="{{ route('schedules.store') }}" method="POST" class="bg-white p-6 shadow-md rounded">
        @csrf
        <div class="mb-4">
            <label for="day_of_week" class="block text-gray-700 font-bold mb-2">Día de la Semana</label>
            <select name="day_of_week" id="day_of_week" class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                <option value="L">Lunes</option>
                <option value="K">Martes</option>
                <option value="M">Miércoles</option>
                <option value="J">Jueves</option>
                <option value="V">Viernes</option>
                <option value="S">Sábado</option>
                <option value="D">Domingo</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="time" class="block text-gray-700 font-bold mb-2">Hora</label>
            <input type="time" name="time" id="time" class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
    </form>
</div>
@endsection
