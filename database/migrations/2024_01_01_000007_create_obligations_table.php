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
        Schema::create('obligations', function (Blueprint $table) {
            $table->id('obligation_id');
            $table->string('obligation_description', 255);
            $table->integer('category_id')->nullable();
            $table->string('server_name', 100)->nullable();
            $table->decimal('quantity', 10, 2);
            $table->string('period', 50);
            $table->integer('alert_time');
            $table->unsignedBigInteger('created_by');
            $table->decimal('last_payment', 10, 2)->nullable();
            $table->date('expiration_date')->nullable();
            $table->text('observations');
            $table->string('internal_reference', 100)->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('review_date')->nullable();
            $table->integer('status')->default(12);
            
            // Foreign keys
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
        Schema::dropIfExists('obligations');
    }
};
