<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luscherpackage extends Model
{
    use HasFactory;

    protected $fillable  = [
        'firstName', 'lastName', 'country', 'city',
        'code', 'phoneNumber', 'address', 'zone',
        'buildingNumber', 'floorNumber', 'postalCode', 'notes',
        'image', 'requestType','email'
    ];
}
