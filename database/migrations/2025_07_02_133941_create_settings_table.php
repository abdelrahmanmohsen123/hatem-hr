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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->text('android_version')->nullable();
            $table->text('ios_version')->nullable();
            $table->tinyInteger('force_update_android_version')->default(0);
            $table->tinyInteger('force_update_ios_version')->default(0);
            $table->tinyInteger('app_active')->default(1);
            // $table->string('vodafone_cash_number')->nullable();
            // $table->string('instapay_cash_number')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('twitter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
