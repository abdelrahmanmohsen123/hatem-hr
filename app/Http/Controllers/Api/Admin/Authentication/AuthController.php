<?php

namespace App\Http\Controllers\Api\Admin\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authentication\LoginRequest;
use App\Http\Resources\Admin\Authentication\AdminResource;
use App\Models\Admin;
use App\Traits\ApiResponder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponder;
    public function login(LoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return $this->setStatusCode('422')->respondWithError(
                __('auth.The provided credentials are incorrect.'),
            );
        }
        $token = $admin->createToken('admin-token', ['*'], Carbon::now()->addMonths(3))->plainTextToken;

        $expiresAt = Carbon::now()->addMonths(3)->format('Y-m-d H:m:i');

        return $this->respondResource(new AdminResource($admin), [
            'message' => __('auth.Login Success!'),
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);
    }

    public function logout()
    {
        // Revoke token
        $admin = authUser('admin');

        if ($admin && $admin->currentAccessToken()) {
            $admin->currentAccessToken()->delete(); // Only if using Sanctum
        }

        return $this->respondWithSuccess(__('general.logout'));
    }



    public function refreshToken(Request $request)
    {


        $user = authUser('admin');

        if (!$user) {
            return $this->setStatusCode(401)->respondWithError(__('auth.unauthenticated'));
        }


        // $token = $user->createToken('user-token')->plainTextToken;
        $token = $user->createToken('admin-token', ['*'], Carbon::now()->addMonths(3))->plainTextToken;

        // $expiresAt = null;
        $expiresAt = Carbon::now()->addMonths(3)->format('Y-m-d H:m:i');
        return $this->respondResource(new AdminResource($user), [
            'message' => __('auth.Login Success!'),
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);
    }
}
