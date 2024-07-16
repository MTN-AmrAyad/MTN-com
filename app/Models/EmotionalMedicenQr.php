<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmotionalMedicenQr extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_name",
        "client_phone",
        "client_country_phone",
        "client_job",
        "client_age",
        "howDoYouHeardAboutLecture",
        "didYouKnowDrAhmedBefore",
        "whatSocialNetworks",
        "whatIsYourOpinionInLecture",
        "q1",
        "q2",
        "q3",
        "other",
    ];
}
