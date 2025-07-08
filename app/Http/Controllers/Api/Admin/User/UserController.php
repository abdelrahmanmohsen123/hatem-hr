<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\Admin\User\UserIndexResource;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->when(request()->has('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('phone', 'like', '%' . request('search') . '%');
            })
            ->paginate(10);
        return $this->respondResource(UserIndexResource::collection($users));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) {
        $user = User::create($request->validated());
        return $this->respondResource(new UserIndexResource($user));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return $this->respondResource(new UserIndexResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return $this->respondResource(new UserIndexResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->respondWithSuccess(__('User deleted successfully'));
    }


    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return $this->respondWithSuccess(__('User restored successfully'));
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(10);
        return $this->respondResource(UserIndexResource::collection($users));
    }
}
