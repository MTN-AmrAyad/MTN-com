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
        Schema::create('brain_ctscan_feedback', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("country_code");
            $table->string("phoneNumber");
            $table->string("q1");
            $table->string("q2");
            $table->string("q3");
            $table->string("q4");
            $table->string("q5");
            $table->string("q6");
            $table->string("q7");
            $table->string("q8");
            $table->string("q9");
            $table->string("q10");
            $table->string("q11");
            $table->string("q12");
            $table->string("q13");
            $table->string("q14")->nullable();
            $table->string("q15")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brain_ctscan_feedback');
    }
};
