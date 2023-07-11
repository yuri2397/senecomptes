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
        Schema::create('account_items', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->default(uniqid());
            $table->boolean('status')->default(true);
            $table->dateTime('attach_at')->nullable()->default(now());
            $table->dateTime('limit_at')->nullable()->default(now()->addMonth());
            $table->foreignId('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_items');
    }
};
