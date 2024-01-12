<?php

namespace App\Http\Controllers\Api;
use App\Services\FirebaseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerificationNotification;
use App\Mail\VerificationMail; // Make sure to include this with a semicolon at the end
use Illuminate\Support\Facades\Mail; // Add this line to use the Mail facade

class AuthController extends Controller
{
    protected $firebaseService;
    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ]);
        } else {
            $verificationCode = rand(1000, 9999);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'pending',
                'verification_code' => $verificationCode,
            ]);

            Mail::to($request->email)->send(new VerificationMail($user->verification_code));

            return response()->json([
                'status' => 200,
                'message' => 'Registration successful. Please check your email to verify your account.',
            ]);
        }
    }

    public function verifyCode(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && $user->status === 'pending' && $user->verification_code == $request->verification_code) {
            $user->status = 'active';
            $user->verification_code = null;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User verified successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unable to verify',
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ]);
        } else {
            $user = User::where('email', $request->email)->where('status', 'active')->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credentials',
                ]);
            } else {
                $token = $user->createToken($user->email.'_Token')->plainTextToken;
                
    // After successful authentication, obtain the admin's FCM token
    $admin = auth()->user();
    $admin->fcm_token = $adminFcmTokenFromDevice; // Replace with the actual FCM token obtained from the admin's device
    $admin->save();

    return response()->json([
        'status' => 200,
        'username' => $admin->name,
        'token' => $token,
        'message' => 'Logged in Successfully',
    ]);
            }
        }
    }
}
