<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAnimation extends Model
{
    use HasFactory;
    protected $table='animation_text';
    protected $fillable=['titleone','titletwo','titlethree','titlefour'];
}
