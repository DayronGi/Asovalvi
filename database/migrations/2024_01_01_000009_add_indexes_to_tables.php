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
        Schema::table('meetings', function (Blueprint $table) {
            $table->index(['meeting_date']);
            $table->index(['status']);
            $table->index(['created_by']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->index(['start_date']);
            $table->index(['status']);
            $table->index(['assigned_to']);
            $table->index(['meeting_id']);
        });

        Schema::table('obligations', function (Blueprint $table) {
            $table->index(['expiration_date']);
            $table->index(['status']);
            $table->index(['period']);
        });

        Schema::table('obligation_payments', function (Blueprint $table) {
            $table->index(['obligation_id']);
            $table->index(['date_ini']);
        });

        Schema::table('meeting_assistants', function (Blueprint $table) {
            $table->index(['meeting_id']);
            $table->index(['user_id']);
        });

        Schema::table('meeting_topics', function (Blueprint $table) {
            $table->index(['meeting_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropIndex(['meeting_date']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_by']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex(['start_date']);
            $table->dropIndex(['status']);
            $table->dropIndex(['assigned_to']);
            $table->dropIndex(['meeting_id']);
        });

        Schema::table('obligations', function (Blueprint $table) {
            $table->dropIndex(['expiration_date']);
            $table->dropIndex(['status']);
            $table->dropIndex(['period']);
        });

        Schema::table('obligation_payments', function (Blueprint $table) {
            $table->dropIndex(['obligation_id']);
            $table->dropIndex(['date_ini']);
        });

        Schema::table('meeting_assistants', function (Blueprint $table) {
            $table->dropIndex(['meeting_id']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('meeting_topics', function (Blueprint $table) {
            $table->dropIndex(['meeting_id']);
        });
    }
};
