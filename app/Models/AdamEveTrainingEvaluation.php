<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdamEveTrainingEvaluation extends Model
{
    protected $table = 'adam_eve_training_evaluation';
    use HasFactory;
    protected $fillable = [
        'name',
        'phoneNumber',
        'meetExpectations',
        'applyLearned',
        'trainingObjectives',
        'isContentOrganized',
        'trainerWasKnowledgeable',
        'qualityOfInstruction',
        'trainerMetTheObjectives',
        'participationWasEncouraged',
        'AdequateTimeWasProvided',
        'MeetingRoomRate',
        'InterpretationRate',
        'trainingOverallRate',
        'WhatIsMostBenefits',
        'WhatIsAspectOfTrainingCouldBeImproved',
        'DescribeYourExperience',
        'OtherComments',
        'DoYouRecommendSomeOne',
        'RecommendedPersonName',
        'RecommendedPersonPhone',
        'country_code',
        'RecommendedPersonCountryCode',
    ];
}
