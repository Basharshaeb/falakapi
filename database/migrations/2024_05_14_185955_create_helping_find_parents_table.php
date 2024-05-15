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
        Schema::create('helping_find_parents', function (Blueprint $table) {
            $table->id();
            $table->dateTime('help_date');
            $table->string('helping_status', 50);
            $table->string('current_image_path')->nullable();
            $table->integer('accuracy')->nullable();
            $table->unsignedBigInteger('helper_user_id')->nullable();
            $table->unsignedBigInteger('Link_child_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helping_find_parents');
    }
};
