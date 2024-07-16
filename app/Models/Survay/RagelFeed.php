<?php

namespace App\Models\Survay;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RagelFeed extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "phoneNumber",
        "country_code",
        "complaints",
        "developmentFeelings",
        "emotionalDevelopment",
        "expectationsMet",
        "financialDevelopment",
        "opinion",
        "recommendation",
        "relationshipDevelopment",
        "suggestions",
    ];
}
