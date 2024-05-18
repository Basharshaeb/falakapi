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
        Schema::table('lost_notification_requests', function (Blueprint $table) {

            $table->string('child_age')->nullable(); // 'varchar(max)' in SQL Server maps to 'text' in Laravel
            $table->string('parent_phone')->nullable();
            $table->string('more_info')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
