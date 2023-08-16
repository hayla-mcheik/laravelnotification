<?php

namespace App\Models;
use App\Models\ServiceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    use HasFactory;
    protected $table='categories_services';
    protected $fillable=['name','slug','status'];

    public function services()
    {
        return $this->hasMany(ServiceModel::class, 'category_id', 'id');
    }
}
