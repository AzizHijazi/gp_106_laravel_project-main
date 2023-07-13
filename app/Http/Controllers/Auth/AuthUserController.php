<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserForgetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AuthUserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required', 'string',
                Password::min(8)
                    ->letters()
                    ->symbols()
                    ->numbers()
                    ->mixedCase()
                    ->uncompromised()
            ],
            'password_confirmation' => 'required|string|same:password',
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $saved = $user->save();
            return response()->json(
                ['status' => $saved, 'message' => $saved ? "Registered successfully" : "Registration failed", 'object' => $user],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function completeProfile(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string|min:7|max:10',
            'birthdate' => 'required|date_format:Y-m-d|before:today',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'gender' => [
                'required',
                Rule::in(['M', 'F']),
            ],
        ]);
        if (!$validator->fails()) {
            $user = $request->user('user');
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->birthdate = $request->input('birthdate');
            $user->gender = $request->input('gender');
            if ($user->image) {
                $oldImagePath = str_replace('/storage', 'public', $user->image);
                Storage::delete($oldImagePath);
            }
            $user->phone = $request->input('phone');
            $user->birthdate = $request->input('birthdate');
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/images');
                $user->image = Storage::url($imagePath);
            }
            $saved = $user->save();
            return response()->json([
                'status' => $saved,
                'message' => $saved ? 'Profile completed successfully' : 'Profile completion failed',
                'object' => $user
            ], $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }



    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            if (Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('user-api-token-' . $user->id);
                $user->token = $token->accessToken;
                return response()->json(['status' => true, 'message' => 'Logged In Successfully', 'object' => $user]);
            } else {
                return response()->json(['status' => false, 'message' => 'Wrong credentials, try again'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user('user');
        $revoked = $user->token()->revoke();
        return response()->json(['status' => $revoked, 'message' => $revoked ? "Logged out successfully" : "Logout failed"], $revoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if (!$validator->fails()) {
            //
            $code = random_int(1000, 9999);
            $user = User::where('email', '=', $request->input('email'))->first();
            $user->verification_code = Hash::make($code);
            $isSaved = $user->save();
            if ($isSaved) {
                Mail::to($user)->send(new UserForgetPasswordEmail($user, $code));
            }
            return response()->json(
                ['status' => $isSaved, 'message' => $isSaved ? 'Forgot code sent successfully' : 'Forgot code sending failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['status' => false, 'message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|exists:users,email',
            'code' => 'required|numeric|digits:4',
            'new_password' => [
                'required', 'confirmed', 'string', Password::min(6)
                    ->letters()
                    ->symbols()
                    ->numbers()
                    ->mixedCase()
                    ->uncompromised()
            ]
        ]);
        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            if (!is_null($user->verification_code)) {
                if (Hash::check($request->input('code'), $user->verification_code)) {
                    $user->password = Hash::make($request->input('new_password'));
                    $user->verification_code = null;
                    $isSaved = $user->save();
                    return response()->json(
                        ['status' => $isSaved, 'message' => $isSaved ? 'Password changed successfully' : 'Password change failed!'],
                        $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
                    );
                } else {
                    return response()->json(
                        ['status' => false, 'message' => 'Verification code is not correct!'],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            } else {
                return response()->json(
                    ['status' => false, 'message' => 'No password reset request exist, operation denied'],
                    Response::HTTP_FORBIDDEN
                );
            }
        } else {
            return response()->json(
                ['status' => false, 'message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'current_password' => 'required|current_password:user',
            'new_password' => [
                'required', 'string', Password::min(6)
                    ->letters()
                    ->symbols()
                    ->numbers()
                    ->mixedCase()
                    ->uncompromised()
            ],
            'password_confirmation' => 'required|string|same:new_password',
        ]);
        if (!$validator->fails()) {
            $user = $request->user('user');
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();
            return response()->json(
                ['status' => $isSaved, 'message' => $isSaved ? 'Password changed successfully' : 'Password change failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['status' => false, 'message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

}
