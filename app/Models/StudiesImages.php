<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudiesImages extends Model
{
    use HasFactory;
    protected $table='case_studies_images';
    protected $fillable=[
        'casestudies_id',
        'image',
        'poster'
    ];
}
