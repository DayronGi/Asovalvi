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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id('meeting_id');
            $table->date('meeting_date');
            $table->time('start_hour')->nullable();
            $table->unsignedBigInteger('called_by')->nullable();
            $table->unsignedBigInteger('director');
            $table->unsignedBigInteger('secretary');
            $table->string('placement', 255)->nullable();
            $table->text('meeting_description');
            $table->text('empty_field')->nullable();
            $table->text('topics')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamp('creation_date')->useCurrent();
            $table->integer('status')->default(3);
            
            // Foreign keys
            $table->foreign('called_by')->references('id')->on('users');
            $table->foreign('director')->references('id')->on('users');
            $table->foreign('secretary')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('status')->references('status')->on('status_descriptions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
