<?php

namespace App\Models;
use App\Models\StudiesImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudies extends Model
{
    use HasFactory;
    protected $table='case_studies';
    protected $fillable=['titleone','descone','titletwo','desctwo','titlethree','descthree','textone','texttwo',
    'textthree','spanone','spantwo','spanthree','disclaimer','color','status'];

    
    public function StudiesImages()
    {
        return $this->hasMany(StudiesImages::class,'casestudies_id','id');
    }
}
