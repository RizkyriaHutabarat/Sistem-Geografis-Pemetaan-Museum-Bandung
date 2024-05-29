<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    protected $table = 'museum';
    use HasFactory;

    protected $fillable = [
        'namamuseum',
        'alamat',
        'latitude',
        'longitude', 
        'jambuka',
        'jamtutup',
        'biayamasuk',   
    ];


}
