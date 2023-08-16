<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyBanner extends Model
{
    use HasFactory;
    protected $table='agency_banner';
    protected $fillable=['image','title','titletwo','description'];
}
