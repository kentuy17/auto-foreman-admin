<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbltaskrunning', function (Blueprint $table) {
            $table->id();
            $table->string('task_name')->nullable();
            $table->text('description')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('taskid');
            $table->integer('userid');
            $table->time('time')->default(DB::raw('CURRENT_TIME'));
            $table->time('end_time')->default(DB::raw('CURRENT_TIME'));
            $table->date('date')->default(DB::raw('CURRENT_DATE'));
            $table->string('status')->nullable();
            $table->string('platform')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbltaskrunning');
    }
};
