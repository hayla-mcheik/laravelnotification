<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function blog()
    {

        $blog = BlogModel::all();

        return view('admin.blog',compact('blog'));
    }

    public function addblog(Request $request)
{
    $blog = new BlogModel();
    $blog->title=$request->input('title');
    $blog->description=$request->input('description');

    if($request->hasFile('image'))
    {
        $image = $request->file('image');
        $type = "";
        if (Str::startsWith($image->getMimeType(), 'image/')) $type = "image";
        if (Str::startsWith($image->getMimeType(), 'video/')) $type = "video";
        $fileName = time().rand(1000,50000) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/', $fileName);
        $uploadFile = 'upload/' . $fileName;
        $image=$uploadFile;
        $blog->image=$image;
    }  

    if($request->input('is_featured', false)){
        $blog->update(['is_featured' => false]);

    }
    $blog->is_featured = $request->input('is_featured', false);
    $blog->type
    = $type;
    $blog->save();
    return back()->withSuccess('Blog has been added');
}

public function updateblog(Request $request ,$id)
{
    $blog = BlogModel::find($id);
    $blog->title=$request->input('title');
    $blog->description=$request->input('description');
    if($request->hasFile('image'))
    {
        
        $image = $request->file('image');
        $type = "";
        if (Str::startsWith($image->getMimeType(), 'image/')) $type = "image";
        if (Str::startsWith($image->getMimeType(), 'video/')) $type = "video";
        $fileName = time().rand(1000,50000) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/', $fileName);
        $uploadFile = 'upload/' . $fileName;
        $image=$uploadFile;
        $blog->type
        = $type;
        $blog->image=$image;
    }  

    if($request->input('is_featured', false)){
        $blog->update(['is_featured' => false]);

    }
    $blog->is_featured = $request->input('is_featured', false);

    $blog->update();
    return back()->withSuccess('Blog has been updated');
}

public function deleteblog($id)
{
    $blog = BlogModel::find($id);
    if($blog->image!=null) unlink($blog->image);
    $blog->delete();
    return back()->withSuccess('Blog has been deleted');
}

}
