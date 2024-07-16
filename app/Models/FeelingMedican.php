<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeelingMedican extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_name", "client_country_code",
        "client_email", "client_name",
        "client_phone",
    ];
}
