<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBackground extends Model
{
    use HasFactory;
    protected $table='home_background';
    protected $fillable=['image','title','description','link'];
}
