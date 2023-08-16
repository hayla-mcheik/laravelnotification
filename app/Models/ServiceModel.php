<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceImage;
use App\Models\CategoryService;
class ServiceModel extends Model
{
    use HasFactory;
    protected $table='services';
    protected $fillable = [
        'category_id',
        'name',
         'description',
        'services',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryService::class, 'category_id','id');
    }
    public function servicesimages()
    {
        return $this->hasMany(ServiceImage::class,'service_id','id');
    }

    public static function totalServices()
{
    return self::count();
}

}
