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
        Schema::create('emotional_medicen_qrs', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_phone')->unique();
            $table->string('client_country_phone');
            $table->string('client_job');
            $table->string('client_age');
            $table->string('howDoYouHeardAboutLecture');
            $table->string('didYouKnowDrAhmedBefore');
            $table->string('whatSocialNetworks');
            $table->string('whatIsYourOpinionInLecture');
            $table->string('q1');
            $table->string('q2');
            $table->string('q3');
            $table->string('other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emotional_medicen_qrs');
    }
};
