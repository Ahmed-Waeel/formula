<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    
    protected $table = 'flights';

    protected $fillable = [
        'flight_id', 'airports', 'hotels', 'activities', 'notes', 'start_date', 'end_date'
    ];
}
