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
        Schema::table('users', function (Blueprint $table) {
            // Check and drop columns that exist
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('users', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
            if (Schema::hasColumn('users', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
            
            // Add new columns
            $table->string('first_name', 100)->after('id');
            $table->string('last_name', 100)->after('first_name');
            $table->string('document_number', 20)->unique()->after('last_name');
            $table->string('user_type', 50)->after('document_number');
            $table->integer('status')->default(2)->after('password');
            
            // Add foreign key constraint
            $table->foreign('status')->references('status')->on('status_descriptions');
            
            // Remove timestamps if they exist
            if (Schema::hasColumn('users', 'created_at')) {
                $table->dropTimestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['status']);
            $table->dropColumn(['first_name', 'last_name', 'document_number', 'user_type', 'status']);
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
};
