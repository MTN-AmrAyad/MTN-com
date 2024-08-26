<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbtAdvancedAugest extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name',
        'client_email',
        'client_job',
        'client_country',
        'client_country_code',
        'client_phone',
        'attendance',
        'attendance_days',
        'reservation',
    ];

    protected $casts = [
        'attendance_days' => 'array',
        'reservation' => 'array',
    ];
}
