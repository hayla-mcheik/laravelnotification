<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeBackground;
use App\Models\HomeVideo;
use App\Models\HomeAnimation;
use App\Models\HomeClient;
use App\Models\TestimonialModel;
use App\Rules\WordLimit;
class HomeeController extends Controller
{
    public function home()
    {
        $homeback = HomeBackground::first();
        return view('admin.home.background',compact('homeback'));
    }
    public function homebackupdate(Request $request)
    {
        $homeback = HomeBackground::first();
        $homeback->title=$request->input('title');
        $homeback->description=$request->input('description');
        $homeback->link=$request->input('link');
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $fileName = time().rand(1000,50000) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/', $fileName);
            $uploadFile = 'upload/' . $fileName;
            $image=$uploadFile;
            $homeback->image=$image;
        }  
        $homeback->update();
        return back()->withSuccess('Background has been updated');
    }
    public function homevideo()
    {
        $homevideo= HomeVideo::first();
        return view('admin.home.video',compact('homevideo'));
    }
    public function homevideoupdate(Request $request)
    {
        $homevideo= HomeVideo::first();
        if($request->hasFile('videoone'))
        {
            $image = $request->file('videoone');
            $fileName = time().rand(1000,50000) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/', $fileName);
            $uploadFile = 'upload/' . $fileName;
            $image=$uploadFile;
            $homevideo->videoone=$image;
        }  
        if($request->hasFile('poster'))
        {
            $poster = $request->file('poster');
            $fileName = time().rand(1000,50000) . '.' . $poster->getClientOriginalExtension();
            $poster->move('upload/', $fileName);
            $uploadFile = 'upload/' . $fileName;
            $poster=$uploadFile;
            $homevideo->poster=$poster;
        } 
        if($request->hasFile('videotwo'))
        {
            $imagetwo = $request->file('videotwo');
            $fileName = time().rand(1000,50000) . '.' . $imagetwo->getClientOriginalExtension();
            $imagetwo->move('upload/', $fileName);
            $uploadFile = 'upload/' . $fileName;
            $imagetwo=$uploadFile;
            $homevideo->videotwo=$imagetwo;
        }  
        $homevideo->update();
        return back()->withSuccess(' Video has been updated');
    }

    public function homeanimationtext()
    {
        $animationtext = HomeAnimation::first();
        return view('admin.home.animationtext',compact('animationtext'));
    }
    public function homeanimationtextupdate(Request $request)
    {
        $animationtext = HomeAnimation::first();
        $animationtext->titleone=$request->input('titleone');
        $animationtext->titletwo=$request->input('titletwo');
        $animationtext->titlethree=$request->input('titlethree');    
        $animationtext->titlefour=$request->input('titlefour');
        $animationtext->update();
        return back()->withSuccess('Text Animation has been updated');
    }

public function client()
{
    $client = HomeClient::all();
    return view('admin.home.client',compact('client'));
}

public function addclient(Request $request)
{
    $client = new HomeClient();
    if($request->hasFile('image'))
    {
        $image = $request->file('image');
        $fileName = time().rand(1000,50000) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/', $fileName);
        $uploadFile = 'upload/' . $fileName;
        $image=$uploadFile;
        $client->image=$image;
    }      
    if($request->hasFile('imagetwo'))
    {
        $imagetwo = $request->file('imagetwo');
        $fileName = time().rand(1000,50000) . '.' . $imagetwo->getClientOriginalExtension();
        $imagetwo->move('upload/', $fileName);
        $uploadFile = 'upload/' . $fileName;
        $imagetwo=$uploadFile;
        $client->imagetwo=$imagetwo;
    }  
    $client->save();
    return back()->withSuccess('Client has been added');
}

public function updateclient(Request $request , $id)
{
    $client = HomeClient::find($id);
    if($request->hasFile('image'))
    {
        $image = $request->file('image');
        $fileName = time().rand(1000,50000) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/', $fileName);
        $uploadFile = 'upload/' . $fileName;
        $image=$uploadFile;
        $client->image=$image;
    }  
    if($request->hasFile('imagetwo'))
    {
        $imagetwo = $request->file('imagetwo');
        $fileName = time().rand(1000,50000) . '.' . $imagetwo->getClientOriginalExtension();
        $imagetwo->move('upload/', $fileName);
        $uploadFile = 'upload/' . $fileName;
        $imagetwo=$uploadFile;
        $client->imagetwo=$imagetwo;
    }  
    $client->update();
    return back()->withSuccess('Client has been updated');
}

public function deleteclient($id)
{
    $client = HomeClient::find($id);
    if($client->image!=null) unlink($client->image);
    $client->delete();
    return back()->withSuccess('Client has been deleted');
}

public function testimonials()
{

    $testimonial= TestimonialModel::all();
    return view('admin.home.testimonials',compact('testimonial'));
}


public function addtestimonials(Request $request)
{
   
    $testimonial= new TestimonialModel();
    $testimonial->name=$request->input('name');
    $testimonial->title=$request->input('title');
    $testimonial->description=$request->input('description');
$words = str_word_count($testimonial->description, 1, '.');
if (count($words) > 80) {
    return back()->with('message', 'Description exceeds the word limit');
}
$preview = implode(' ', array_slice($words, 0, 80));
$testimonial->description = $preview;
    if($request->hasFile('image'))
    {
        $image = $request->file('image');
        $fileName = time().rand(1000,50000) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/', $fileName);
        $uploadFile = 'upload/' . $fileName;
        $image=$uploadFile;
        $testimonial->image=$image;
    }  
    $testimonial->save();
    return back()->withSuccess('Testimonial has been added');
}

public function updatetestimonials(Request $request , $id)
{
    $rules = [
        'description' => ['required', new WordLimit(100)],
    ];
    $validatedData = $request->validate($rules);
    $testimonial = TestimonialModel::find($id);
    $testimonial->name=$request->input('name');
    $testimonial->title=$request->input('title');
    $testimonial->description=$request->input('description');
$words = str_word_count($testimonial->description, 1, '.');
if (count($words) > 80) {
    return back()->with('message', 'Description exceeds the word limit');
}
$preview = implode(' ', array_slice($words, 0, 80));
$testimonial->description = $preview;
    if($request->hasFile('image'))
    {
        $image = $request->file('image');
        $fileName = time().rand(1000,50000) . '.' . $image->getClientOriginalExtension();
        $image->move('upload/', $fileName);
        $uploadFile = 'upload/' . $fileName;
        $image=$uploadFile;
        $testimonial->image=$image;
    }  
    $testimonial->save();
    return back()->withSuccess('Testimonial has been added');
}

public function deletetestimonials($id)
{
    $testimonial = TestimonialModel::find($id);
    if($testimonial->image!=null) unlink($testimonial->image);
    $testimonial->delete();
    return back()->withSuccess('Testimonial has been deleted');
}
}
