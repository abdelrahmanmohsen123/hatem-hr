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
        Schema::create('currency_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('base_currency_id')->references('id')->on('currencies');
            $table->foreignId('target_currency_id')->references('id')->on('currencies');
            $table->foreignId('country_id')->references('id')->on('countries');
            $table->decimal('base_rate', 16, 6); // 1 SAR = X target_currency
            $table->decimal('target_rate', 16, 6); // 1 target_currency = X base_currency
            $table->enum('status_price', ['up', 'down', 'same'])->default('same');
            $table->string('latest_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_prices');
    }
};
