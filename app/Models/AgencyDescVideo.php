<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyDescVideo extends Model
{
    use HasFactory;
    protected $table='agency_desc_video';
    protected $fillable=['agencydescr','video','title','agencytitle',
    'agencydesc','agencytitletwo','agencydesctwo','agencytitlethree','agencydescthree','agencytitlefour',
'agencydescfour','animattext','gettrs','getrsdesc'];

}
