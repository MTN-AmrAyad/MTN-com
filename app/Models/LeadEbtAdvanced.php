<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadEbtAdvanced extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_name",
        "client_email",
        "client_country_phone",
        "client_phone",
    ];
}
