<?php

namespace App\Models\Survay;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebt1 extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "phoneNumber", "country_code",
        "detectRelation", "forgetFeeling", "knowFeeling",
        "feeling-body", "feeling", "reciveThings",
        "situation-ideas", "secChange", "diffFeeling",
        "threeAxies", "knowImage", "balanceFeeling",
        "suggestion"
    ];
}
