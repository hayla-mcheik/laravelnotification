<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\CategoryService;
use App\Models\ServiceModel;
use App\Models\ServiceImage;
use App\Http\Requests\ServiceFormRequest;


class ServicesController extends Controller
{
 public function index()
 {
   $service = ServiceModel::all();
    return view('admin.services.index',compact('service'));
 }
 public function create()
 {
    $categoryservice = CategoryService::all();
    return view('admin.services.create',compact('categoryservice'));
 }
 public function store(ServiceFormRequest $request)
 {
    $validatedData = $request->validated();
    $category = CategoryService::findOrFail( $validatedData['category_id']);
  $service =  $category->services()->create([
'category_id' => $validatedData['category_id'],
'name' => $validatedData['name'],
'description' => $validatedData['description'],
'services' => $validatedData['services'],

'status' => $request->status == true ? '1':'0'
    ]);
    if($request->hasFile('image')){
      $uploadPath = 'uploads/services/';
    
      $i=1;
      foreach($request->file('image') as $imageFile){
          $extention = $imageFile->getClientOriginalExtension();
          $filename = time().$i++.'.'.$extention;
          $imageFile->move($uploadPath,$filename);
          $finalImagePathName = $uploadPath.$filename;
    
          $service->servicesimages()->create([
              'service_id' => $service->id,
              'image' => $finalImagePathName,
          ]);
      }
    }
    return redirect('/admin/services')->with('message','Service Added Successfully');
 }

public function edit(int $service_id)
{
   $categoryservice = CategoryService::all();
   $service = ServiceModel::findOrFail($service_id);
   return view('admin.services.edit',compact('service','categoryservice'));
}

public  function update(ServiceFormRequest $request, int  $service_id)
{
  $validatedData = $request->validated();
   $service=ServiceModel::findOrFail($service_id);
  if($service)  
  {
   $service->update([
   'category_id' => $validatedData['category_id'],
   'name' => $validatedData['name'],
   'description' => $validatedData['description'],
'services' => $validatedData['services'],
   'status' => $request->status == true ? '1':'0'
       ]);
       if($request->hasFile('image')){
         $uploadPath = 'uploads/services/';
       
         $i=1;
         foreach($request->file('image') as $imageFile){
             $extention = $imageFile->getClientOriginalExtension();
             $filename = time().$i++.'.'.$extention;
             $imageFile->move($uploadPath,$filename);
             $finalImagePathName = $uploadPath.$filename;
       
             $service->servicesimages()->create([
                 'service_id' => $service->id,
                 'image' => $finalImagePathName,
             ]);
         }
       }

return redirect('/admin/services')->with('message','Service Updated Successfully');
  } 
  else 
  {
    return redirect('admin/services')->with('message','No Such Service Id Found');
  }   
}

public function destroyImage(int $services_image_id)
{
  $serviceImage = ServiceImage::findOrFail($services_image_id);
  if(File::exists($serviceImage->image)){
    File::delete($serviceImage->image);
  }
  $serviceImage->delete();
  return redirect('admin/services')->with('message','Services Image Deleted');
}


public function destroy(int $services_id)
{
  $service= ServiceModel::findOrFail($services_id);
  if($service->servicesimages){
    foreach($service->servicesimages as $image){
      if(File::exists($image->image)){
        File::delete($image->image);
      }
    }
  }
  $service->delete();
  return redirect('admin/services')->with('message','Services Deleted with all its image');
}


}
