<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdamAndEveMarage extends Model
{
    use HasFactory;
     protected $table = 'adam_and_eve_marage';
    protected $fillable = [
        "client_name", "client_email", "client_job", "client_country", "client_country_code", "client_phone", "attendance", "attendance_days","reservation"
    ];
}
