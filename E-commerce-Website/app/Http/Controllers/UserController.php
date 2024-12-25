<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
   public function logIn(){
    return view('pages.login-page');
   }


   public function UserLogin($UserEmail): JsonResponse
   {
       try {
       $UserEmail = trim($UserEmail);

           $OTP = rand(1000, 9999);
           $details = ['code' => $OTP];
           Mail::to($UserEmail)->send(new OTPMail($details));
           $user = User::updateOrCreate(['email' => $UserEmail], ['email' => $UserEmail, 'otp' => $OTP]);

           return ResponseHelper::Out('success', "A 4 Digit OTP has been sent to your email address", 200);
       } catch (Exception $e) {
           return ResponseHelper::Out('fail', $e->getMessage(), 500);
       }
   }

   public function VerifyLogin($UserEmail, $OTP): JsonResponse
{
 $UserEmail = trim($UserEmail);
  $OTP = trim($OTP);

       $verification = User::where('email', $UserEmail)->where('otp', $OTP)->first();


       if ($verification) {

           User::where('email', $UserEmail)->where('otp', $OTP)->update(['otp' => '0']);
           $token = JWTToken::CreateToken($UserEmail, $verification->id);
           return ResponseHelper::Out('success', "", 200)->cookie('token', $token, 60 * 24 * 30);
       } else {

           return ResponseHelper::Out('fail', null, 401);
       }

   }


   public function VerifyPage()
    {
        return view('pages.verify-page');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }



public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->user();

        $finduser = User::where('google_id', $user->id)->first();

        if ($finduser) {
            Auth::login($finduser);
            return redirect()->intended('/');
        } else {
            $newUser = User::create([
                'email' => $user->email,
                'google_id' => $user->id,
            ]);
            Auth::login($newUser);
            return redirect()->intended('/');
        }
    } catch (Exception $e) {
        Log::error('Google OAuth callback error: ' . $e->getMessage());
        return redirect()->route('login')->with('error', 'There was an issue with Google login. Please try again.');
    }
}
}


