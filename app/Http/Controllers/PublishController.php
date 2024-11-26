<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledPublication;
use Carbon\Carbon;

class PublishController extends Controller {
    // Guardar una publicación programada
    public function schedule(Request $request) {
        $request->validate([
            'content' => 'required|string',
            'scheduled_time' => 'required|date|after:now',
        ]);

        $publication = ScheduledPublication::create([
            'content' => $request->input('content'),
            'scheduled_time' => $request->input('scheduled_time'),
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Publication scheduled successfully.',
            'data' => $publication,
        ], 201);
    }

    // Listar publicaciones programadas
    public function list() {
        $publications = ScheduledPublication::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->orderBy('scheduled_time', 'asc')
            ->get();

        return response()->json($publications);
    }

    // Procesar una publicación (llamada por el worker)
    public function process($id) {
        $publication = ScheduledPublication::find($id);

        if (!$publication || $publication->status !== 'pending') {
            return response()->json(['message' => 'Publication not found or already processed.'], 404);
        }

        // Simular envío a redes sociales
        $publication->status = 'sent'; // Asumimos éxito
        $publication->save();

        return response()->json(['message' => 'Publication processed successfully.']);
    }
}
