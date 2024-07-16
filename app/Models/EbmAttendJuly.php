<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbmAttendJuly extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name',
        'client_email',
        'client_country',
        'client_country_code',
        'client_phone',
        'attendance',
        'reservation',
        'attendance_days',
        'chair_number',
        'section_sets'
    ];

    protected $casts = [
        'reservation' => 'array',
        'attendance_days' => 'array',
    ];
}
