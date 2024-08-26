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
        Schema::create('lead_ebt_advanceds', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_email')->unique();
            $table->string('client_country_phone');
            $table->string('client_phone')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_ebt_advanceds');
    }
};
