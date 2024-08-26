<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbmExam extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_name",
        "client_email",
        "client_country",
        "client_country_code",
        "client_phone",
        "answers",
        "client_score",
    ];
}
