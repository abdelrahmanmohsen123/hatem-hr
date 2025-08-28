<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserIndexResource;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthenticationController extends Controller
{
    //
    use ApiResponder;

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->respondResource(new UserIndexResource($user), ['message' => 'User logged in successfully', 'token' => $token]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'age' => 'nullable|integer|min:18|max:100',
            'experience' => 'nullable|string',
            'national_id' => 'nullable|string|unique:users',
            'password' => 'required|min:6',


        ]);

        $user = User::create([
            'username' => $request->username,
            'age' => $request->age,
            'experience' => $request->experience,
            'national_id' => $request->national_id,
            'password' => Hash::make($request->password),
            'user_id' => rand(1000, 9999),
        ]);

        return $this->respondResource(new UserIndexResource($user), ['message' => 'User registered successfully']);
    }

    public function getUserData(Request $request)
    {



        // If user_id is provided, use it; otherwise use authenticated user's ID
        if ($request->user_id) {
            // Decrypt user_id if it's encrypted (for mobile security)
            try {
                $decrypteduser_id = is_numeric($request->user_id) ? $request->user_id : decrypt($request-> user_id);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Invalid user ID format'], 400);
            }


            $user = User::find($decrypteduser_id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return $this->respondResource(new UserIndexResource($user), ['message' => 'User data fetched successfully', 'user_id' => $decrypteduser_id, 'user_name' => $user->username]);
        } else {
            $authenticatedUser = auth()->user();
            // If no user_i provided, get user from token
            if (!$authenticatedUser) {
                return response()->json(['message' => 'Authentication required'], 401);
            }
            $user = $authenticatedUser;
        }

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $this->respondResource(new UserIndexResource($user), ['message' => 'User data fetched successfully']);
    }
}
