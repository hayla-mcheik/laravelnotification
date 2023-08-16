<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutDesc;
class AboutController extends Controller
{
    public function about()
    {
   
    
        $aboutdesc = AboutDesc::first();
        return view('admin.about',compact('aboutdesc'));
    }
    public function updateaboutdesc(Request $request)
    {
        $aboutdesc = AboutDesc::first();
        $aboutdesc->description=$request->input('description');
        $aboutdesc->update();
        return back()->withSuccess('About Description has been updated');
    }
}
