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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username', 50)->nullable();
            $table->string('user_type', 50)->nullable();
            $table->string('full_name')->nullable();
            $table->integer('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('username_type')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->string('volunteer_activation_status', 50)->default('yes')->nullable();
            $table->integer('voulnteer_child_location_id')->nullable();
            $table->string('fcm_token')->nullable();

            $table->text('main_image_path')->nullable();
            $table->integer('verification_code')->unique()->nullable();
            $table->text('qe_code_info')->nullable();
            $table->string('kinshipT', 50)->nullable();
            $table->integer('main_person_in_charge_id')->nullable();
            $table->string('child_status', 50)->nullable();
            $table->integer('boundry')->nullable()->default(5);
            $table->text('todayimagePath')->nullable();
            $table->text('AdditionalInformation')->nullable()->default('nothing');
            $table->integer('year_of_birth')->nullable();
            $table->text('qr_code_link')->nullable();
            $table->string('is_connect', 50)->default('yes')->nullable();
            $table->integer('voulnteer_child_Location_id_child')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
