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
        Schema::create('feeling_medcine_attends', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_email')->unique();
            $table->string('client_country_code');
            $table->string('client_phone')->unique();
            $table->string('client_country');
            $table->string('section_sets');
            $table->string('chair_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeling_medcine_attends');
    }
};
