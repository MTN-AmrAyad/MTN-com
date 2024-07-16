<?php

namespace App\Models\Survay;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtrlAnatomicalOutLineFeed extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name',
        'client_country_code',
        'client_phone',
        'distinguishFeelingsAndThoughts',
        'bodyExpressionOfFeeling',
        'effectOfDisturbedFeelingsOnBody',
        'generalMeaningOfPhysicalDisorder',
        'knowingFeelingVsExperiencingIt',
        'bodySideDisorder',
        'feelingDifferentBrainLayers',
        'trunkBrainFeelings',
        'connectionAndProtection',
        'feelingsOfInability',
        'emotionalOwnership',
        'onenessWithFeelingsAndPossessions',
        'disruptedEmotionalOwnership',
        'suggestions',
    ];
}
