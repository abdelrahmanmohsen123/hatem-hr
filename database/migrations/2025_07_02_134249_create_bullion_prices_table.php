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
        Schema::create('bullion_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->references('id')->on('currencies');
            $table->foreignId('bullion_id')->references('id')->on('bullions');
            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->string('base_price')->nullable();
            $table->string('dollar_price')->nullable();
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
        Schema::dropIfExists('bullion_prices');
    }
};
