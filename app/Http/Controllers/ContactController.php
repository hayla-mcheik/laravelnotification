<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;
class ContactController extends Controller
{
public function contact()
{

    $contact = ContactModel::first();
    return view('admin.contact',compact('contact'));
}
public function updatecontact(Request $request)
{
    $contact = ContactModel::first();
    $contact->subsc_text=$request->input('subsc_text');
    $contact->subsc_footer=$request->input('subsc_footer');
    $contact->loca_dubai=$request->input('loca_dubai');
    $contact->loca_beirut=$request->input('loca_beirut');
    $contact->email_join=$request->input('email_join');
    $contact->email_work=$request->input('email_work');
    $contact->dubai_phone=$request->input('dubai_phone');
    $contact->beirut_phone=$request->input('beirut_phone');
    $contact->faceb=$request->input('faceb');
    $contact->insta=$request->input('insta');
    $contact->twitter=$request->input('twitter');
    $contact->linkedin=$request->input('linkedin');
    $contact->youtube=$request->input('youtube');
    $contact->update();
    return back()->withSuccess('Contact has been updated');
}
}
