<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImgDetails extends Model
{
    use HasFactory;
    protected $table='project_img_details';
    protected $fillable=['project_id','image','poster','type'];
}
