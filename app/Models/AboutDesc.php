<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutDesc extends Model
{
    use HasFactory;
    protected $table='about_desc';
    protected $fillable=['description'];
}
