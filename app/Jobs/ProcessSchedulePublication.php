<?php

namespace App\Jobs;

use App\Models\ScheduledPublication;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessScheduledPublication implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $publication;

    public function __construct(ScheduledPublication $publication) {
        $this->publication = $publication;
    }

    public function handle() {
        // Simular el envío a redes sociales
        $this->publication->status = 'sent'; // Asumimos éxito por ahora
        $this->publication->save();
    }
}
