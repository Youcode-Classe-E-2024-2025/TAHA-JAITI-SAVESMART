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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('family_id')->nullable()->index();
            $table->foreignId('category_id')->nullable()->index();
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['income', 'expense']);
            $table->enum('frequency', ['monthly', 'daily', 'weekly', 'one-time']);
            $table->date('date_received')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
