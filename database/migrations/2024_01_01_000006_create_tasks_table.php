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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('task_id');
            $table->unsignedBigInteger('meeting_id')->nullable();
            $table->date('start_date');
            $table->integer('estimated_time');
            $table->string('units', 20);
            $table->text('task_description');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->text('observations')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamp('creation_date')->useCurrent();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('review_date')->nullable();
            $table->integer('status')->default(5);
            
            // Foreign keys
            $table->foreign('meeting_id')->references('meeting_id')->on('meetings');
            $table->foreign('assigned_to')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('reviewed_by')->references('id')->on('users');
            $table->foreign('status')->references('status')->on('status_descriptions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
