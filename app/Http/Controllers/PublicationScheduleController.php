<?php

namespace App\Http\Controllers;

use App\Models\PublicationSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationScheduleController extends Controller
{
    public function index()
    {
        $schedules = PublicationSchedule::where('user_id', Auth::id())->get();
        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|string|max:1',
            'time' => 'required|date_format:H:i',
        ]);

        PublicationSchedule::create([
            'user_id' => Auth::id(),
            'day_of_week' => $request->day_of_week,
            'time' => $request->time,
        ]);

        return redirect()->route('schedule.index')->with('success', 'Horario creado con éxito.');
    }

    public function edit(PublicationSchedule $schedule)
    {
        return view('schedule.edit', compact('schedule'));
    }

    public function update(Request $request, PublicationSchedule $schedule)
    {
        $request->validate([
            'day_of_week' => 'required|string|max:1',
            'time' => 'required|date_format:H:i',
        ]);

        $schedule->update($request->only(['day_of_week', 'time']));

        return redirect()->route('schedule.index')->with('success', 'Horario actualizado con éxito.');
    }

    public function destroy(PublicationSchedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedule.index')->with('success', 'Horario eliminado con éxito.');
    }
}
