<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLogin(Request $request)
    {
        // $validator = Validator(['guard' => $request->guard], []);
        $request->merge(['guard' => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin,hub'
        ]);
        session()->put('guard', $request->input('guard'));
        if (!$validator->fails()) {
            return response()->view('dashboard.auth.login');
        } else {
            abort(404);
        }
    }
    //exists:admins,email|
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'nullable|in:on'
        ]);
        $guard = session('guard');
        if (Auth::guard($guard)->attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        } else {
            return redirect()->back()->with('failed', 'Credentials error, check and try again!');
        }
    }

    public function logout(Request $request)
    {
        $guard = session('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('cms.show-login', $guard);
    }

    public function editPassword()
    {
        return response()->view('dashboard.auth.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $guard = session('guard');

        $request->validate([
            'old_password' => 'required|string|current_password:' . $guard,
            'new_password' => 'required|string|confirmed',
        ]);

            $user = $request->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();
            return redirect()->route('cms.home');
    }
    
    public function forgotPassword(Request $request) {
        return response()->view('dashboard.auth.forgot-password');
    }

    public function sendResetEmail(Request $request) {
        $validator = Validator($request->all(), [
            'email' => 'required|string|email|exists:admins,email',
        ]);

        if(! $validator->fails()) {
            $status = Password::sendResetLink(['email' => $request->input('email')]);
            return $status == Password::RESET_LINK_SENT 
                ? response()->json(['status'=>true, 'message' => __($status)], Response::HTTP_OK) 
                : response()->json(['status'=>false, 'message' => __($status)], Response::HTTP_BAD_REQUEST);
        }else {
            return response()->json(['status'=>false, 'message' => $validator->getMessageBag()->first()], 
                    Response::HTTP_BAD_REQUEST);
        }
    }

    public function showResetPassword(Request $request, $token) {
        return response()->view('dashboard.auth.reset-password',['token'=>$token, 'email'=>$request->input('email')]);
    }

    public function resetPassword(Request $request) {
        $validator = Validator($request->all(), [
            'password'=>['required','string','confirmed',
                    Password::min(3)
                        ->letters()
                        ->symbols()
                        ->uncompromised()
                        ->mixedCase()
                        ->numbers()
                    ],
            'email'=>'required|email',
            'token'=>'required'
        ]);
        if(! $validator->fails()) {
            //
            // dd($request->all());
            $status = Password::reset($request->all(), function($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ]);
                $user->save();
                event(new PasswordReset($user));
            });

            return $status == Password::PASSWORD_RESET 
                ? response()->json(['status'=>true, 'message' => __($status)], Response::HTTP_OK) 
                : response()->json(['status'=>false, 'message' => __($status)], Response::HTTP_BAD_REQUEST);
        }else {
            //
            return response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    //verified email
    public function showVerifyEmail() {
        return response()->view('dashboard.auth.verify-email');
    }

    //
    public function send(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->back();
    }

    //
    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('cms/admin');
    }
}
