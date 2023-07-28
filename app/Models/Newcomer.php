<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newcomer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'surname',
        'othername',
        'gender',
        'phonenumber',
        'marital_status',
        'age_bracket',
        'occupation',
        'nationality',
        'visitable',
        'state_of_residence',
        'nearest_bus_stop',
        'house_address',
        'special_message',
        'prayer_request', 
        'email',
        'profile_picture'
    ];

}
