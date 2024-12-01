<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledPublicationsTable extends Migration {
    public function up() {
        Schema::create('scheduled_publications', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->datetime('scheduled_time');
            $table->string('status', 20)->default('pending');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('scheduled_publications');
    }
}
