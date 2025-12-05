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
        Schema::create('donation_methods', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['bank', 'mobile']);
            $table->string('title');
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('platform')->nullable()->comment('bkash, nogod, rocket, other');
            $table->string('platform_name')->nullable();
            $table->string('merchant_type')->nullable();
            $table->string('number')->nullable();
            $table->integer('order')->default(0)->index();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['type', 'is_active']);
            $table->index(['type', 'order']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_methods');
    }

};