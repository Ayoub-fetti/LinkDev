<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('connections', function (Blueprint $table) {
            // Drop the existing foreign key first
            $table->dropForeign(['source_user_id']);
            
            // Re-add it with cascade on delete
            $table->foreign('source_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
        });
    }

    public function down(): void
    {
        Schema::table('connections', function (Blueprint $table) {
            $table->dropForeign(['source_user_id']);
            $table->foreign('source_user_id')
                  ->references('id')
                  ->on('users');
                  
        });
    }
};