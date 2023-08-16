<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyMembers extends Model
{
    use HasFactory;

    protected $table='agency_members';
    protected $fillable=['image','title','job','description','quote','text'];
}
