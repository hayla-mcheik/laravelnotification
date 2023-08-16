<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAgency extends Model
{
    use HasFactory;
    protected $table='images_agency';
    protected $fillable =['imageone','imagetwo','imagethree','imagefour','imagefive','imagesix'];
}
