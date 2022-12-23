<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    
    protected $table = 'flights';

    protected $fillable = [
        'flight_id', 'options', 'notes', 'start_date', 'end_date', 'flight_to'
    ];
}
