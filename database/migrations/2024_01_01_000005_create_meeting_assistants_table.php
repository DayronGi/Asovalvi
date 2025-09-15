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
        Schema::create('meeting_assistants', function (Blueprint $table) {
            $table->unsignedBigInteger('meeting_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('status')->default(2);
            
            // Composite primary key
            $table->primary(['meeting_id', 'user_id']);
            
            // Foreign keys
            $table->foreign('meeting_id')->references('meeting_id')->on('meetings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status')->references('status')->on('status_descriptions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_assistants');
    }
};
