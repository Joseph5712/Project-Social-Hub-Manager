<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicationSchedule;

class PublicationScheduleController extends Controller {
    // Mostrar todos los horarios del usuario
    public function index() {
        $schedules = PublicationSchedule::where('user_id', auth()->id())->get();
        return view('schedules.index', compact('schedules'));
    }

    // Mostrar formulario para crear un nuevo horario
    public function create() {
        return view('schedules.create');
    }

    // Guardar un nuevo horario
    public function store(Request $request) {
        $request->validate([
            'day_of_week' => 'required|integer|between:0,6', // Domingo a Sábado
            'time' => 'required|date_format:H:i',
        ]);

        PublicationSchedule::create([
            'user_id' => auth()->id(),
            'day_of_week' => $request->input('day_of_week'),
            'time' => $request->input('time'),
        ]);

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    // Editar un horario existente
    public function edit($id) {
        $schedule = PublicationSchedule::findOrFail($id);
        return view('schedules.edit', compact('schedule'));
    }

    // Actualizar un horario existente
    public function update(Request $request, $id) {
        $schedule = PublicationSchedule::findOrFail($id);

        $request->validate([
            'day_of_week' => 'required|integer|between:0,6',
            'time' => 'required|date_format:H:i',
        ]);

        $schedule->update($request->all());
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    // Eliminar un horario
    public function destroy($id) {
        $schedule = PublicationSchedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
