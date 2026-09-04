<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_approval', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('managerid');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->date('date');
            $table->unsignedInteger('duration')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_approval');
    }
};
