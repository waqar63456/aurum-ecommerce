<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Upload Profile Image
        $profileImageName = null;
        if ($request->hasFile('profile_image')) {
            $profileImageName = time() . '_' . Str::random(10) . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images/profiles'), $profileImageName);
        }

        // Generate OTP and Expiry Time
        $otp = random_int(100000, 999999);
        $otpExpiresAt = now()->addMinutes(2); // OTP expires in  minutes

        // Create Customer
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $profileImageName,
            'otp' => $otp,
            'otp_expires_at' => $otpExpiresAt,
        ]);

        // Send OTP Email
        Mail::to($customer->email)->send(new SendOtpMail($otp, $customer));

        return response()->json([
            'message' => 'Customer registered successfully. Please check your email for the OTP.',
            'customer' => $customer,
        ], 201);
    }

    public function verifyOtp(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'otp' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $customer = Customer::where('email', $request->email)->first();

    if (!$customer) {
        return response()->json(['message' => 'Invalid email'], 400);
    }

    if ($customer->otp_expires_at < now()) {
        return response()->json(['message' => 'OTP expired, please request a new one'], 400);
    }

    if ($customer->otp !== $request->otp) {
        return response()->json(['message' => 'Invalid OTP'], 400);
    }

    // OTP Verified, remove OTP fields
    $customer->otp = null;
    $customer->otp_expires_at = null;
    $customer->save();

    // Store user data in the session
    Session::put('customer', $customer);

    return response()->json(['message'=> 'OTP verified successfully']);
}
  public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $customer = Customer::where('email', $request->email)->first();

    if (!$customer || !Hash::check($request->password, $customer->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Store user in session
    Session::put('customer', $customer);
    
    // Return user data (without sensitive info)
    return response()->json([
        'message' => 'Logged In Successfully',
        'user' => [
            'id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'profile_image' => $customer->profile_image,
        ]
    ]);
}

    public function logout(Request $request)
    {
        // Revoke the token
        $request->user()->tokens()->delete();

        // Clear session data
        Session::forget('customer');

        // Redirect to home with a success message
        return response()->json(['message'=> 'Logout Successfully']);
    }

    
    public function resendOtp(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $customer = Customer::where('email', $request->email)->first();

    if (!$customer) {
        return response()->json(['message' => 'Invalid email'], 400);
    }

    // Generate new OTP and update expiry time
    $otp = random_int(100000, 999999);
    $otpExpiresAt = now()->addMinutes(2);

    // Update customer record
    $customer->otp = $otp;
    $customer->otp_expires_at = $otpExpiresAt;
    $customer->save();

    // Resend OTP Email
    Mail::to($customer->email)->send(new SendOtpMail($otp, $customer));

    return response()->json([
        'message' => 'A new OTP has been sent to your email.',
    ], 200);
}







 // Step 1: Send OTP
 public function resetsendOTP(Request $request)
 {
     try {
         // Validate the email
         $validator = Validator::make($request->all(), [
             'email' => 'required|email|exists:customers,email',
         ]);
 
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 422);
         }
 
         // Generate OTP
         $otp = rand(100000, 999999);
         $email = $request->email;
 
         // Find the customer by email
         $customer = DB::table('customers')->where('email', $email)->first();
 
         // Ensure that the customer exists
         if (!$customer) {
             return response()->json(['error' => 'Customer not found.'], 404);
         }
 
         // Save OTP to database (you could store this in a separate table or user's meta data)
         DB::table('password_resets')->updateOrInsert(
             ['email' => $email],
             ['token' => Hash::make($otp), 'created_at' => Carbon::now()]
         );
 
         // Send OTP to user via email
         Mail::to($customer->email)->send(new SendOtpMail($otp, $customer));
 
         return response()->json(['message' => 'OTP sent successfully'], 200);
     } catch (\Exception $e) {
         // Handle the exception
         return response()->json(['error' => $e->getMessage()], 500);
     }
 }
 
    
 

 // Step 2: Verify OTP
 public function resetverifyOTP(Request $request)
 {
     $validator = Validator::make($request->all(), [
         'email' => 'required|email|exists:customers,email',
         'otp'   => 'required|digits:6',
     ]);

     if ($validator->fails()) {
         return response()->json(['error' => $validator->errors()], 422);
     }

     $email = $request->email;
     $otp = $request->otp;

     // Retrieve the token (hashed OTP) from the database
     $passwordReset = DB::table('password_resets')->where('email', $email)->first();

     if (!$passwordReset) {
         return response()->json(['error' => 'Invalid OTP or email'], 400);
     }

     // Check if the OTP is valid and not expired (expire time could be e.g., 10 minutes)
     if (!Hash::check($otp, $passwordReset->token)) {
         return response()->json(['error' => 'Invalid OTP'], 400);
     }

     if (Carbon::parse($passwordReset->created_at)->addMinutes(10)->isPast()) {
         return response()->json(['error' => 'OTP has expired'], 400);
     }

     // OTP is verified; allow user to reset password
     return response()->json(['message' => 'OTP verified successfully'], 200);
 }

 // Step 3: Reset Password
 public function resetPassword(Request $request)
 {
     $validator = Validator::make($request->all(), [
         'email' => 'required|email|exists:customers,email',
         'password' => 'required|min:8|confirmed',
     ]);

     if ($validator->fails()) {
         return response()->json(['error' => $validator->errors()], 422);
     }

     $email = $request->email;

     // Check if there is a valid OTP for this email
     $passwordReset = DB::table('password_resets')->where('email', $email)->first();

     if (!$passwordReset) {
         return response()->json(['error' => 'No OTP found for this email'], 400);
     }

     // Find the user and reset the password
     $user = Customer::where('email', $email)->first();
     if (!$user) {
         return response()->json(['error' => 'User not found'], 404);
     }

     $user->password = Hash::make($request->password);
     $user->save();

     // Optionally, delete the OTP record after successful reset
     DB::table('password_resets')->where('email', $email)->delete();

     return response()->json(['message' => 'Password reset successfully'], 200);
 }

   
        }
