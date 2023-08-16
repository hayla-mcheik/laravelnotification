<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ServiceModel;
use App\Models\Category;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminAuth extends Controller
{
    public function loginpage()
    {
        if(User::where('level','Superadmin')->count()>0)
        {
            return view('admin.login');
        }
        else
        {
            return view('admin.register');
        }
    }

    public function login(Request $request)
    {


        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ],
        [
            'email.required'=>'Please enter your email address',
            'password.required'=>'Please enter your password'
        ]
        );
        if(Auth::guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return back()->withErrors('Login details are not valid.');
        }
    }
    public function register(Request $request)
    {
        $customer=new User();
        $customer->name=$request->input('name');
        $customer->email=$request->input('email');
        $customer->password=Hash::make($request->input('password'));
        $customer->level='Superadmin';
        $customer->status='Activated';
        $customer->save();
        Auth::guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]);
        return back()->withSuccess('Account has been created successfully');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
    public function dashboard()
    {

        $count = DB::table('visitor_counts')->value('count');
        $totalServices = ServiceModel::totalServices();
        $totalCategory = Category::totalCategories();

    
  
        return view('admin.dashboard', compact('count','totalServices','totalCategory'));

    }
    public function users()
    {
        $users=Customer::all();
        return view('admin.users',compact('users'));
    }
    public function admins()
    {
        $admins=User::all();
        return view('admin.admins',compact('admins'));
    }
    public function addadmins(Request $request)
    {
        $admin=new User();
        $admin->name=$request->input('name');
        $admin->email=$request->input('email');
        $admin->password=Hash::make($request->input('password'));
        $admin->level='Admin';
        $admin->status='Activated';
        $admin->save();
        return back()->with('Success','Admin has been added.');
    }
    public function updateadmins(Request $request,$id)
    {
        $admin=User::find($id);
        $admin->name=$request->input('name');
        $admin->email=$request->input('email');
        $admin->password=Hash::make($request->input('password'));
        $admin->level='Admin';
        $admin->status='Activated';
        $admin->update();
        return back()->with('Success','Admin has been updated.');
    }
}
