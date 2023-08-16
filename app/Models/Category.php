<?php

namespace App\Models;
use App\Models\Project;
use App\Models\ProjectImgDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $fillable=['name','slug','status'];

    public function projects()
    {
        return $this->belongsToMany(Project::class)->with('projectimgdetails');
    }


public static function totalCategories()
{
    return self::count();
}

}
