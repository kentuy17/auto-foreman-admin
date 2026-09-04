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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable()->unique();
            $table->binary('user_image')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->string('department');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('type');
            $table->string('status');
            $table->string('active_status')->nullable();
            $table->string('site')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
