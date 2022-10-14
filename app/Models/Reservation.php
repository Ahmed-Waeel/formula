<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    
    protected $table = 'reservations';

    protected $fillable = [
        'reservation_id', 'customer_id', 'flight_id', 'date',
    ];
}
