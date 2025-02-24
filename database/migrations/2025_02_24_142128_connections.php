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
        Schema::create("connections", function (Blueprint $table) {
            $table->id();
            $table->foreignId("source_user_id")->constrained("users");
            $table->foreignId("target_user_id")->constrained("users");
            $table->enum("status", ["pending", "accepted", "rejected"]);
            $table->timestamp("request_date");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};