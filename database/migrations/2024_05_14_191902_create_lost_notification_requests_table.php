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
        Schema::create('lost_notification_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_title'); // 'varchar(max)' in SQL Server maps to 'text' in Laravel
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('child_id')->nullable();
            $table->date('request_lost_notification_date')->nullable();
            $table->unsignedBigInteger('last_location_id')->nullable();
            $table->string('notification_status', 50)->nullable();
            $table->string('comments', 50)->nullable();
            $table->unsignedBigInteger('last_response_by')->nullable();
            $table->unsignedBigInteger('found_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_notification_requests');
    }
};
