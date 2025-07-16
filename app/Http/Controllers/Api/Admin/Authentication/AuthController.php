<?php

namespace App\Http\Controllers\Api\Admin\Authentication;

use Carbon\Carbon;
use App\Models\Admin;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Support\FileUploader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Authentication\LoginRequest;
use App\Http\Requests\Admin\Authentication\UpdateProfileRequest;
use App\Http\Resources\Admin\Authentication\AdminResource;

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

    public function my_profile()
    {
        // Revoke token
        $admin = authUser('admin');
        return $this->respondResource(new AdminResource($admin), [
            'message' => __('auth.profile_retrieved'),
           
        ]);
    }

     public function update(UpdateProfileRequest $request)
    {
        $admin = authUser('admin');

        // dd($request->all());
        $updateData = [];
        
        if ($request->has('name') && $request->name !== $admin->name) {
            $updateData['name'] = $request->name;
        }else{
            $updateData['name'] = 'Admin';
        }
         if ($request->has('password')) {
            $updateData['password'] = Hash::make($request->passsword);
        }else{
            $updateData['password'] = $admin->password;
        }
       

        $admin->update($updateData);


        return $this->respondResource(new AdminResource($admin), [
            'message' => __('auth.profile_updated'),
        ]);

        
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
