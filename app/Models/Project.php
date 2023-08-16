<?php

namespace App\Models;
use App\Models\ProjectImage;
use App\Models\ProjectImgDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table ='projects';
    protected $fillable=['categories','slug','name','titletwo','titlethree','description','status','featured','width', 'class'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function projectImages()
    {
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }

    public function updateCategories(Request $request, Project $project)
    {
        $project->categories()->sync($request->input('categories'));

        return redirect()->back()->with('success', 'Categories updated successfully.');
    }
    
    public function projectimgdetails()
    {
        return $this->hasMany(ProjectImgDetails::class, 'project_id', 'id');
    }
}
