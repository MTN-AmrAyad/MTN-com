<?php

namespace App\Models\Survay;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebt2MainLevelPartTwo extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "phoneNumber",
        "country_code",
        "attention",
        "curruntCode",
        "codeAndSign",
        "detectSetuation",
        "codeImage",
        "codeYourLive",
        "selfFeeling",
        "trainning",
        "suggestion",
    ];
}
