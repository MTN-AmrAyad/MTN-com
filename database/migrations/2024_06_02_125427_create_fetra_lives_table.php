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
        Schema::create('fetra_lives', function (Blueprint $table) {
            $table->id();
            $table->string("client_name");
            $table->string("client_email")->unique();
            $table->string("client_country_code");
            $table->string("client_phone")->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fetra_lives');
    }
};
