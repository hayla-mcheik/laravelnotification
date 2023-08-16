<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeClient extends Model
{
    use HasFactory;
    protected $table='client';
    protected $fillable=['image','imagetwo'];
}
