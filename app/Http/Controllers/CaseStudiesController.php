<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseStudies;
use App\Models\StudiesImages;
use App\Http\Requests\StudiesFormRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CaseStudiesController extends Controller
{
  public function index()
  {

    $casestudies = CaseStudies::all();
    return view('admin.casestudies.index', compact('casestudies'));
  }

  public function create()
  {
    return view('admin.casestudies.create');
  }

  public function store(StudiesFormRequest $request)
  {
    $casestudies = new CaseStudies();
    $validatedData = $request->validated();
    $casestudies->titleone = $validatedData['titleone'];
    $casestudies->descone = $validatedData['descone'];
    $casestudies->titletwo = $validatedData['titletwo'];
    $casestudies->desctwo = $validatedData['desctwo'];
    $casestudies->titlethree = $validatedData['titlethree'];
    $casestudies->descthree = $validatedData['descthree'];
    $casestudies->textone = $validatedData['textone'];
    $casestudies->texttwo = $validatedData['texttwo'];
    $casestudies->textthree = $validatedData['textthree'];
    $casestudies->disclaimer = $validatedData['disclaimer'];
    $casestudies->color = $validatedData['color'];
    $casestudies->status = $request->status == true ? '1' : '0';
    $casestudies->spanone = $validatedData['spanone'];
    $casestudies->spantwo = $validatedData['spantwo'];
    $casestudies->spanthree = $validatedData['spanthree'];
    $casestudies->save();

    if ($request->hasFile('image')) {
      if ($casestudies->image != null) unlink($casestudies->image);
      $uploadPath = 'uploads/casestudies/';

      $i = 1;
      foreach ($request->file('image') as $imageFile) {
        $type = "";
        if (Str::startsWith($imageFile->getMimeType(), 'image/')) $type = "image";
        if (Str::startsWith($imageFile->getMimeType(), 'video/')) $type = "video";

        $extention = $imageFile->getClientOriginalExtension();
        $filename = time() . $i++ . '.' . $extention;
        $imageFile->move($uploadPath, $filename);
        $finalImagePathName = $uploadPath . $filename;


        $casestudies->StudiesImages()->create([
          'casestudies_id' => $casestudies->id,
          'image' => $finalImagePathName,
          'type' => $type
        ]);
      }
    }





    return redirect('admin/casestudies')->with('message', 'Case Studies Added Successfully');
  }


  public function edit(int $studies_id)
  {
    $casestudies = CaseStudies::findOrFail($studies_id);
    return view('admin.casestudies.edit', compact('casestudies'));
  }

  public function update(StudiesFormRequest $request, int $studies_id)
  {
    $validatedData = $request->validated();
    $casestudies = CaseStudies::find($studies_id);
    if ($casestudies) {
      $casestudies->titleone = $validatedData['titleone'];
      $casestudies->descone = $validatedData['descone'];
      $casestudies->titletwo = $validatedData['titletwo'];
      $casestudies->desctwo = $validatedData['desctwo'];
      $casestudies->titlethree = $validatedData['titlethree'];
      $casestudies->descthree = $validatedData['descthree'];
      $casestudies->textone = $validatedData['textone'];
      $casestudies->texttwo = $validatedData['texttwo'];
      $casestudies->textthree = $validatedData['textthree'];
      $casestudies->disclaimer = $validatedData['disclaimer'];
      $casestudies->color = $validatedData['color'];
      $casestudies->status = $request->status == true ? '1' : '0';
      $casestudies->spanone = $validatedData['spanone'];
      $casestudies->spantwo = $validatedData['spantwo'];
      $casestudies->spanthree = $validatedData['spanthree'];
      $casestudies->update();
      if ($request->hasFile('image')) {
        $uploadPath = 'uploads/casestudies/';

        $i = 1;
        foreach ($request->file('image') as $imageFile) {
          $type = "";
          if (Str::startsWith($imageFile->getMimeType(), 'image/')) $type = "image";
          if (Str::startsWith($imageFile->getMimeType(), 'video/')) $type = "video";
  
          $extention = $imageFile->getClientOriginalExtension();
          $filename = time() . $i++ . '.' . $extention;
          $imageFile->move($uploadPath, $filename);
          $finalImagePathName = $uploadPath . $filename;


          $casestudies->StudiesImages()->create([
            'casestudies_id' => $casestudies->id,
            'image' => $finalImagePathName,
            'type' => $type
          ]);
        }
      }
      return redirect('admin/casestudies')->with('message', 'Case Studies Updated Successfully');
    } else {
      return redirect('admin/casestudies')->with('message', 'No Such Case Studies Id Found');
    }
  }

  public function destroyImage(int $studies_image_id)
  {
    $studiesImage = StudiesImages::findOrFail($studies_image_id);
    if (File::exists($studiesImage->image)) {
      File::delete($studiesImage->image);
    }
    $studiesImage->delete();
    return redirect('admin/casestudies')->with('message', 'Case Studies Image Deleted');
  }

  public function destroy(int $studies_id)
  {
    $casestudies = CaseStudies::findOrFail($studies_id);
    if ($casestudies->StudiesImages) {
      foreach ($casestudies->StudiesImages as $image) {
        if (File::exists($image->image)) {
          File::delete($image->image);
        }
      }
    }
    $casestudies->delete();
    return redirect('admin/casestudies')->with('message', 'Case Studies Deleted with all its image');
  }




  public function casestudiesdetails($studies_id)
  {
    $casestudies = CaseStudies::with('StudiesImages')->find($studies_id);
    return view('admin.casestudies.details', compact('casestudies'));
  }

  public function addcasestudiesdetails(Request $request, $studies_id)
  {
    $details = new StudiesImages();
    $details->casestudies_id = $studies_id;
    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $type = "";
      if (Str::startsWith($image->getMimeType(), 'image/')) $type = "image";
      if (Str::startsWith($image->getMimeType(), 'video/')) $type = "video";
      $name = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
      $image->move('uploads/projects/', $name);
      $file = 'uploads/projects/' . $name;
      $details->image = $file;
      $details->type = $type;
    }
    if ($request->input('is_featured', false)) {
      CaseStudies::find($studies_id)->StudiesImages()->update(['is_featured' => false]);
    }
    $details->is_featured = $request->input('is_featured', false);
    $details->save();
    return back()->withSuccess('Project Details has been added');
  }
  public function updatecasestudiesdetails(Request $request, $studies_id, $id)
  {

    $details = StudiesImages::find($id);
    if ($request->hasFile('image')) {
      if ($details->image != null) unlink($details->image);
      $image = $request->file('image');
      $type = "";
      if (Str::startsWith($image->getMimeType(), 'image/')) $type = "image";
      if (Str::startsWith($image->getMimeType(), 'video/')) $type = "video";
      $name = time() . rand(1000, 50000) . '.' . $image->getClientOriginalExtension();
      $image->move('uploads/projects/', $name);
      $file = 'uploads/projects/' . $name;
      $details->image = $file;
      $details->type = $type;
    }
    if ($request->input('is_featured', false)) {
      CaseStudies::find($studies_id)->StudiesImages()->update(['is_featured' => false]);
    }
    $details->is_featured = $request->input('is_featured', false);

    $details->update();
    return back()->withSuccess('Project Details has been updated.');
  }
  public function deletecasestudiesdetails($studies_id, $id)
  {
    $details = StudiesImages::find($id);
    if ($details->image != null) unlink($details->image);
    $details->delete();
    return back()->withSuccess('Casestudies Details has been deleted.');
  }
}
