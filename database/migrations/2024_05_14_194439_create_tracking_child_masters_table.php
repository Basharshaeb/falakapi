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
        Schema::create('tracking_child_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_child_id');
            $table->unsignedBigInteger('child_id');
            $table->date('start_tracking_date');
            $table->float('start_child_location_long')->nullable();
            $table->float('start_child_location_lat')->nullable();
            $table->date('end_tracking_time')->nullable();
            $table->string('child_tracking_statues', 50)->default('safe');
            $table->string('parent_reaction', 50)->default('open');
            $table->decimal('last_child_location_longitude')->nullable();
            $table->decimal('last_child_location_latitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_child_masters');
    }
};
