<?php

namespace App\Models\Survay;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainEbt2 extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "phoneNumber",
        "country_code",
        "firstTime",
        "attendNumber",
        "threeAxes",
        "diffAxes",
        "oneValue",
        "compBalance",
        "anxietyFeeling",
        "analyseFeeling",
        "suggestion",
    ];
}
