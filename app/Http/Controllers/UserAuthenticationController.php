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
            'balance_vacations_days' => rand(0, 30),
        ]);

        return $this->respondResource(new UserIndexResource($user), ['message' => 'User registered successfully']);
    }

    public function getUserData(Request $request)
    {



        // If user_id is provided, use it; otherwise use authenticated user's ID
        if ($request->user_id) {
            // Decrypt user_id if it's encrypted (for mobile security)
            try {
                $decrypteduser_id = is_numeric($request->user_id) ? $request->user_id : $this->decryptMobileUserId($request->user_id);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Invalid user ID format'], 400);
            }


            $user = User::where('user_id', $decrypteduser_id)->first();

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return $this->respondResource(new UserIndexResource($user), ['message' => 'User data fetched successfully', 'user_id' => $decrypteduser_id, 'user_name' => $user->username]);
        } else {
            $authenticatedUser = auth('sanctum')->user();
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

    private function decryptMobileUserId($encryptedUserId)
    {
        // Decrypt the hashed user ID to get original value (e.g., 1231)
        // Mobile sends: hatem + user_id + timestamp, then reversed
        // Example: hatem1231167890123 -> 32109876813214etah

        // Step 1: Reverse the string to undo strrev()
        $unreversed = strrev($encryptedUserId);
        // Now we have: hatem1231167890123

        $name = 'hatem'; // Fixed prefix
        $nameLength = strlen($name); // 5 characters

        // Step 2: Check if it starts with our name
        if (strpos($unreversed, $name) === 0) {
            // Step 3: Remove 'hatem' from beginning
            $withoutName = substr($unreversed, $nameLength);
            // Now we have: 1231167890123

            // Step 4: Remove timestamp (last 10 digits) to get original user_id
            $timestampLength = 10;
            $originalUserId = substr($withoutName, 0, -$timestampLength);
            // Now we have: 1231

            return $originalUserId;
        }

        throw new \Exception('Invalid encrypted user ID format');


    }
}
