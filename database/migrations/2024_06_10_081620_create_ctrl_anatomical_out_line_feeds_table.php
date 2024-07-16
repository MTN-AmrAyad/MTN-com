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
        Schema::create('ctrl_anatomical_out_line_feeds', function (Blueprint $table) {
            $table->id();
            $table->string("client_name");
            $table->string("client_country_code");
            $table->string("client_phone")->unique();
            $table->string("distinguishFeelingsAndThoughts");
            $table->string("bodyExpressionOfFeeling");
            $table->string("effectOfDisturbedFeelingsOnBody");
            $table->string("generalMeaningOfPhysicalDisorder");
            $table->string("knowingFeelingVsExperiencingIt");
            $table->string("bodySideDisorder");
            $table->string("feelingDifferentBrainLayers");
            $table->string("trunkBrainFeelings");
            $table->string("connectionAndProtection");
            $table->string("feelingsOfInability");
            $table->string("emotionalOwnership");
            $table->string("onenessWithFeelingsAndPossessions");
            $table->string("disruptedEmotionalOwnership");
            $table->string("suggestions")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctrl_anatomical_out_line_feeds');
    }
};
