<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Customer;
use App\Models\States;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerAuth extends Controller
{
    public function getcities(Request $request)
    {
        $cities=Cities::where('state_id',$request->state)->get();
        return response()->json(['status'=>200,'cities'=>$cities]);
    }
    public function checknick(Request $request)
    {
        $nickname=$request->input('nickname');
        $customer=Customer::where('nickname',$nickname)->get();
        if($nickname==null) return response()->json(['status'=>300,'message'=>'Please enter your nick name']);
        if(count($customer)>0) return response()->json(['status'=>300,'message'=>'Please choose another nick name']);
        else return response()->json(['status'=>200,'message'=>'Nick name accepted.']);
    }
    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ],
        [
            'email.required'=>'Please enter your email address',
            'password.required'=>'Please enter your password'
        ]
        );
        if($validator->fails()) return back()->with('errLogin',$validator);
        if(Auth::guard('customer')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
        {
            return back();
        }
        else
        {
            return back()->with('errLogin','Login details are not valid.');
        }
    }
    public function loginapi(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ],
        [
            'email.required'=>'Please enter your email address',
            'password.required'=>'Please enter your password'
        ]
        );
        if($validator->fails()) return response()->json(['status'=>400,'msg'=>$validator->errors()->first()]);
        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return response()->json(['status'=>200,'msg'=>'Login success.']);
        }
        else return response()->json(['status'=>300,'msg'=>'Login failed.']);

    }
    public function register(Request $request)
    {
            $validator=Validator::make($request->all(),[
            'fname'=>'required',
            'lname'=>'required',
            'nickname'=>'required',
            'email'=>'required|email|unique:customers,email',
            'phone'=>'required|min:8|max:8',
            'state'=>'required',
            'city'=>'required',
            'password'=>'required|min:8'
        ],
        [
            'fname.required'=>'Please enter your first name',
            'lname.required'=>'Please enter your last name',
            'nickname.required'=>'Please enter your Nick name',
            'email.required'=>'Please enter your email address',
            'email.email'=>'Please enter your valid email address',
            'email.unique'=>'This email address has been taken',
            'password.required'=>'Please enter your password',
            'phone.required'=>'Please enter your phone number',
            'phone.min'=>'Please enter your valid phone number',
            'phone.max'=>'Please enter your valid phone number',
            'state.required'=>'Please enter your state',
            'city.required'=>'Please enter your city',
        ]
        );
        if($validator->fails())
        {
            return back()->with('errRegister', $validator->errors()->first())->withInput()  ;
        }
        $customer=new Customer();
        $customer->fname=$request->input('fname');
        $customer->lname=$request->input('lname');
        $customer->nickname=$request->input('nickname');
        $customer->email=$request->input('email');
        $customer->password=Hash::make($request->input('password'));
        $customer->phone=$request->input('phone');
        $customer->state=$request->input('state');
        $customer->city=$request->input('city');
        $customer->dob=$request->input('dob');
        $customer->status='Activated';
        $customer->save();
        Auth::guard('customer')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]);
        return back()->withSuccess('Account has been created successfully');
    }
    public function registerapi(Request $request)
    {
            $validator=Validator::make($request->all(),[
            'fname'=>'required',
            'lname'=>'required',
            'nickname'=>'required',
            'email'=>'required|email|unique:customers,email',
            'phone'=>'required|min:8|max:8',
            'state'=>'required',
            'city'=>'required',
            'password'=>'required|min:8'
        ],
        [
            'fname.required'=>'Please enter your first name',
            'lname.required'=>'Please enter your last name',
            'nickname.required'=>'Please enter your Nick name',
            'email.required'=>'Please enter your email address',
            'email.email'=>'Please enter your valid email address',
            'email.unique'=>'This email address has been taken',
            'password.required'=>'Please enter your password',
            'phone.required'=>'Please enter your phone number',
            'phone.min'=>'Please enter your valid phone number',
            'phone.max'=>'Please enter your valid phone number',
            'state.required'=>'Please enter your state',
            'city.required'=>'Please enter your city',
        ]
        );
        if($validator->fails())
        {
            return response()->json(['status'=>400,'msg'=>$validator->errors()->first()]);
        }
        $customer=new Customer();
        $customer->fname=$request->input('fname');
        $customer->lname=$request->input('lname');
        $customer->nickname=$request->input('nickname');
        $customer->email=$request->input('email');
        $customer->password=Hash::make($request->input('password'));
        $customer->phone=$request->input('phone');
        $customer->state=$request->input('state');
        $customer->city=$request->input('city');
        $customer->dob=$request->input('dob');
        $customer->status='Activated';
        $customer->save();
        Auth::guard('customer')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]);
        return response()->json(['status'=>200,'msg'=>'Register success.']);
    }
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('index');
    }
    public function dashboard()
    {
        return view('customer.dashboard');
    }
}
