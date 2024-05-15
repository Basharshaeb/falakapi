<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lost_notification_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('response_by_person_id');
            $table->string('response_status', 50);
            $table->date('response_date');
            $table->float('longitude');
            $table->float('latitude');
            $table->string('current_image_path', 50)->nullable();
            $table->integer('accuracy')->nullable();
            $table->string('comments', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_notification_responses');
    }
};
