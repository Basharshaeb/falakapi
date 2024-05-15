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
        Schema::create('find_lost_children', function (Blueprint $table) {
            $table->id();
            $table->string('response_title', 50)->nullable();
            $table->integer('helper_id')->nullable();
            $table->dateTime('findLost_child_date')->nullable();
            $table->integer('approximate_age')->nullable();
            $table->string('response_image_path', 1000)->nullable();
            $table->string('notification_status')->nullable();
            $table->text('comments')->nullable();
            $table->integer('location_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('find_lost_children');
    }
};
