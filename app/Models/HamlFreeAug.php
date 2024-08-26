<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HamlFreeAug extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_name",
        "client_country",
        "client_country_code",
        "client_phone",
        "attendance",
        "areYouSubscribed",
        "fromWhereDoYouKnowAhmedElDemelawy",
    ];
}
