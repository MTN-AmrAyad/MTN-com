<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeelingMedcineAttend extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_name", "client_country_code",
        "client_email", "client_name",
        "client_phone", "client_country",
        'chair_number', 'section_sets'
    ];
}
