<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartWorkModel extends Model
{
    use HasFactory;
    protected $table='start_work';
    protected $fillable = ['fname','lname','phone','email','msg','file'];
}
