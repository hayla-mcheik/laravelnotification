<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectImgDetails;
use Illuminate\Http\UploadedFile;


class ProductController extends Controller
{

  public function index()
  {
    $projects = Project::all();
    return view('admin.projects.index', compact('projects'));
  }
  public function create()
  {
    $categories = Category::all();
    return view('admin.projects.create', compact('categories'));
  }

  public function store(ProductFormRequest $request)
  {
    $validatedData = $request->validated();

    $project = Project::create([

      'name' => $validatedData['name'],
      'slug' => Str::slug($validatedData['slug']),
      'titletwo' => $validatedData['titletwo'],
      'titlethree' => $validatedData['titlethree'],
      'description' => $validatedData['description'],
      'status' => $request->status == true ? '1' : '0',
      'featured' => $request->featured == true ? '1' : '0',
      'width' => $validatedData['width'],
      'class' => $validatedData['class'],
    ]);

    $categories = $request->input('categories');

    $project->categories()->attach($categories);

    if ($request->hasFile('image')) {
      $uploadPath = 'uploads/projects/';

      $i = 1;
      foreach ($request->file('image') as $imageFile) {

        $type = "";
        if (Str::startsWith($imageFile->getMimeType(), 'image/')) $type = "image";
        if (Str::startsWith($imageFile->getMimeType(), 'video/')) $type = "video";

        $extention = $imageFile->getClientOriginalExtension();
        $filename = time() . $i++ . '.' . $extention;
        $imageFile->move($uploadPath, $filename);
        $finalImagePathName = $uploadPath . $filename;
        dd($finalImagePathName);
        $project->projectimgdetails()->create([
          'project_id' => $project->id,
          'image' => $finalImagePathName,
          'type' => $type
        ]);
      }
      
    }

    return redirect('/admin/projects')->with('message', 'Project Added Successfully');
  }

  public function edit(int $project_id)
  {
    $categories = Category::all();
    $project = Project::findOrFail($project_id);
    return view('admin.projects.edit', compact('categories', 'project'));
  }

  public function update(ProductFormRequest $request, int $project_id)
  {
    $validatedData = $request->validated();
    $project = Project::findOrFail($project_id);
    if ($project) {
      $project->update([

        'name' => $validatedData['name'],
        'slug' => Str::slug($validatedData['slug']),
        'titletwo' => $validatedData['titletwo'],
        'titlethree' => $validatedData['titlethree'],
        'description' => $validatedData['description'],
        'status' => $request->status == true ? '1' : '0',
        'featured' => $request->featured == true ? '1' : '0',
        'width' => $validatedData['width'],
        'class' => $validatedData['class'],
      ]);
      $categories = $request->input('categories');
      // dd($categories);
      $project->categories()->sync($categories);

      if ($request->hasFile('image')) {
        if ($project->image != null) unlink($project->image);
        $uploadPath = 'uploads/projects/';

        $i = 1;
        foreach ($request->file('image') as $imageFile) {
          $type = "";
          if (Str::startsWith($imageFile->getMimeType(), 'image/')) $type = "image";
          if (Str::startsWith($imageFile->getMimeType(), 'video/')) $type = "video";
          $extention = $imageFile->getClientOriginalExtension();
          $filename = time() . $i++ . '.' . $extention;
          $imageFile->move($uploadPath, $filename);
          $finalImagePathName = $uploadPath . $filename;

          $project->projectimgdetails()->create([
            'project_id' => $project->id,
            'image' => $finalImagePathName,
            'type' => $type
          ]);
        }
      }

      return redirect('/admin/projects')->with('message', 'Project Updated Successfully');
    } else {
      return redirect('admin/projects')->with('message', 'No Such Project Id Found');
    }
  }

  public function destroyImage(int $project_image_id)
  {
    $projectImage = ProjectImgDetails::findOrFail($project_image_id);
    if (File::exists($projectImage->image)) {
      File::delete($projectImage->image);
    }


    $projectImage->delete();
    return response()->json(['message' => 'deleted'], 200);
    // return redirect('admin/projects')->with('message','Project Image Deleted');
  }

  public function sortImages(Request $request)
  {
    $ids = $request->input('ids');
    $order = 1;
    $urll = "";
    foreach ($ids as $id) {
      if ($id != null) {
        $url = $id;
        $decodedUrl = urldecode($url);
        $parsedUrl = parse_url($decodedUrl);
        $path = $parsedUrl['path'];
        $start = strpos($path, env('APP_URL') . '/');
        $subpath = substr($path, $start);
        $urll = trim($subpath, "/");
        $image = ProjectImage::where('image', $urll)->first();
        $image->order = $order;
        $image->save();
        $order++;
      }
    }
    return response()->json(['success' => $urll]);
  }

  public function destroy(int $project_id)
  {
    $project = Project::findOrFail($project_id);
    if ($project->projectimgdetails) {
      foreach ($project->projectimgdetails as $image) {
        if (File::exists($image->image)) {
          File::delete($image->image);
        }
      }
    }
    $project->categories()->detach();
    $project->delete();
    return redirect('admin/projects')->with('message', 'Project Deleted with all its image');
  }





  public function projectdetails($project_id)
  {
    $project = Project::with('projectimgdetails')->find($project_id);
    return view('admin.projects.details', compact('project'));
  }
  public function addprojectdetails(Request $request, $project_id)
  {
    // dd($request->hasFile('image'));
    $details = new ProjectImgDetails();
    $details->project_id = $project_id;
    if ($request->hasFile('image')) {
      // dd(1);
      $uploadPath = 'uploads/projects/';
      $i = 1;
      // dd($request->file('image'));
      $imageFile = $request->file('image');
      // dd($imageFile);
      // foreach ($request->file('image') as $imageFile) {
      $type = "";
      if (Str::startsWith($imageFile->getMimeType(), 'image/')) $type = "image";
      if (Str::startsWith($imageFile->getMimeType(), 'video/')) $type = "video";

      $extention = $imageFile->getClientOriginalExtension();
      $filename = time() . $i++ . '.' . $extention;
      $imageFile->move($uploadPath, $filename);
      $finalImagePathName = $uploadPath . $filename;

      
      $details->project_id
        = $project_id;
      $details->image
        = $finalImagePathName;
      $details->type
        = $type;
    }


    if ($request->hasFile('poster')) {
      // dd(1);
      $uploadPath = 'uploads/projects/';
      $i = 1;
      // dd($request->file('image'));
      $imageFileposter = $request->file('poster');


      $extention = $imageFileposter->getClientOriginalExtension();
      $filename = time() . $i++ . '.' . $extention;
      $imageFileposter->move($uploadPath, $filename);
      $finalImagePathNameposter = $uploadPath . $filename;

      $details->project_id
        = $project_id;
      $details->poster
        = $finalImagePathNameposter;
    }



    // }
    if ($request->input('is_featured', false)) {
      Project::find($project_id)->projectimgdetails()->update(['is_featured' => false]);
    }
    $details->is_featured = $request->input('is_featured', false);
    $details->save();
    return back()->withSuccess('Project Details has been added');
  }

  public function updateprojectdetails(Request $request, $project_id, $id)
  {
    // dd($request->input('is_featured'));
    $details = ProjectImgDetails::find($id);
    // dd($request->hasFile('image'));
    if ($request->hasFile('image')) {
      if ($details->image != null  && File::exists($details->image)) {
        // DD(1);
        unlink($details->image);
      }
      $uploadPath = 'uploads/projects/';
      $imageFile = $request->file('image');
      $i = 1;
      // foreach ($request->file('image') as $imageFile) {
      $type = "";
      if (Str::startsWith($imageFile->getMimeType(), 'image/')) $type = "image";
      if (Str::startsWith($imageFile->getMimeType(), 'video/')) $type = "video";
      $extention = $imageFile->getClientOriginalExtension();
      $filename = time() . $i++ . '.' . $extention;
      $imageFile->move($uploadPath, $filename);
      $finalImagePathName = $uploadPath . $filename;

      $details->project_id
        = $project_id;
      $details->image
        = $finalImagePathName;
      $details->type
        = $type;
      // $details->projectimgdetails()->create([
      //   'project_id' => $project->id,
      //   'image' => $finalImagePathName,
      //   'type' => $type
      // ]);
      // }
    }

    if ($request->hasFile('poster')) {
      if ($details->poster != null  && File::exists($details->poster)) {
        // DD(1);
        unlink($details->poster);
      }
      $uploadPath = 'uploads/projects/';
      $imageFileposter = $request->file('poster');
      $i = 1;
      $extention = $imageFileposter->getClientOriginalExtension();
      $filename = time() . $i++ . '.' . $extention;
      $imageFileposter->move($uploadPath, $filename);
      $finalImagePathNameposter = $uploadPath . $filename;

      $details->project_id
        = $project_id;
      $details->poster
        = $finalImagePathNameposter;
    }

    if ($request->input('is_featured', false)) {
      Project::find($project_id)->projectimgdetails()->update(['is_featured' => false]);
    }
    $details->is_featured = $request->input('is_featured', false);
    $details->update();
    return back()->withSuccess('Project Details has been updated.');
  }
  public function deleteprojectdetails($project_id, $id)
  {
    $details = ProjectImgDetails::find($id);
    if ($details->image != null) unlink($details->image);
    $details->delete();
    return back()->withSuccess('Project Details has been deleted.');
  }
}
