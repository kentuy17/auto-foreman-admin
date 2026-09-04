<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bugsreports', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->text('description');
            $table->date('date_report');
            $table->time('time_report');
            $table->string('status')->default('open');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bugsreports');
    }
};
