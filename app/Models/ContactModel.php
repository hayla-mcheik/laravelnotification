<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;
    protected $table='contact';
    protected $fillable=['subsc_text','subsc_footer','loca_dubai','loca_beirut','email_join','email_work','dubai_phone','beirut_phone','faceb','insta','twitter','linkedin','youtube'];

}
