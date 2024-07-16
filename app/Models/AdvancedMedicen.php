<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancedMedicen extends Model
{
    use HasFactory;
         protected $table = 'advanced_medicen';
    protected $fillable = [
        "client_name",
        "client_email",
        "client_country",
        "client_country_code",
        "client_phone",
    ];
}
