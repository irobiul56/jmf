<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle');
            $table->string('main_image')->nullable();
            $table->timestamps();
        });

        // Insert default donation data
        $this->insertDefaultDonationData();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }

    /**
     * Insert default donation data.
     */
    private function insertDefaultDonationData(): void
    {
        DB::table('donations')->insert([
            [
                'title' => 'Support Our Cause',
                'subtitle' => 'Your donation helps us continue our mission of serving humanity and building a better society',
                'main_image' => 'images/donation/donate.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
};