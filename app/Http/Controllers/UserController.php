<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponseTrait;
    
    // function __construct()
    // {
    //     $this->middleware(['permission:view-user'], ['only' => ['index,show']]);
    //     $this->middleware(['permission:create-user'], ['only' => ['store']]);
    //     $this->middleware(['permission:update-user'], ['only' => ['update']]);
    //     $this->middleware(['permission:delete-user'], ['only' => ['destroy']]);
    // }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            return $this->customeResponse($users, "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
 

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     try {
    //         return $this->customeResponse($user, 'Done', 200);
    //     } catch (\Throwable $th) {
    //         Log::error($th);
    //         return $this->customeResponse(null, "Error, Something went wrong", 500);
    //     }
    // }

    public function show($userId)
{
    try {
        $user = User::where('user_id', $userId)->firstOrFail();
        return $this->customeResponse($user, 'Done', 200);
    } catch (\Throwable $th) {
        Log::error($th);
        return $this->customeResponse(null, "Error, Something went wrong", 500);
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->name = $request->input('name') ?? $user->name;
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();
            return $this->customeResponse($user, 'User updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return $this->customeResponse("", 'User deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
}
