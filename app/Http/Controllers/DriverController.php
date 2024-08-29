<?php
namespace App\Http\Controllers;

use Illuminate\Http\Requests\LoginRequest;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Driver;
use Illuminate\Support\Facades\Log;


class DriverController extends Controller
{
    use ApiResponseTrait;

    // function __construct()
    // {
    //     $this->middleware(['permission:view-driver'], ['only' => ['index,show']]);
    //     $this->middleware(['permission:create-driver'], ['only' => ['store']]);
    //     $this->middleware(['permission:update-driver'], ['only' => ['update']]);
    //     $this->middleware(['permission:delete-driver'], ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $drivers = Driver::all();
            return $this->customeResponse($drivers, "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        try {
            $driver = Driver::create([
                'username' => $request->username,
                'license_number' => $request->license_number,
                'vehicle_type' => $request->vehicle_type,
                'password' => Hash::make($request->password),
                'availability' => $request->availability,
            ]);
            return $this->customeResponse($driver, 'Driver created successfully', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        try {
            return $this->customeResponse($driver, 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        try {
            $driver->username = $request->input('username') ?? $driver->username;
            $driver->license_number = $request->input('license_number') ?? $driver->license_number;
            $driver->vehicle_type = $request->input('vehicle_type') ?? $driver->vehicle_type;
            $driver->password = $request->input('password') ? Hash::make($request->input('password')) : $driver->password;
            $driver->availability = $request->input('availability') ?? $driver->availability;
            $driver->save();
            return $this->customeResponse($driver, 'Driver updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        try {
            $driver->delete();
            return $this->customeResponse("", 'Driver deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }




    public function login(LoginRequest $request)
    {
        
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

} 


// use App\Http\Requests\StoreDriverRequest;
// use App\Http\Requests\UpdateDriverRequest;
// use App\Http\Requests\LoginRequest; // استيراد الطلب الجديد
// use App\Http\Traits\ApiResponseTrait;
// use App\Models\Driver;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Http\Request;
// // use JWTAuth;
// // use Tymon\JWTAuth\Exceptions\JWTException;

// class DriverController extends Controller
// {
//     use ApiResponseTrait;

//     /**
//      * Display a listing of the drivers.
//      */
//     public function index()
//     {
//         try {
//             $drivers = Driver::all();
//             return $this->customeResponse($drivers, "Drivers retrieved successfully", 200);
//         } catch (\Throwable $th) {
//             Log::error('Error retrieving drivers: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error retrieving drivers", 500);
//         }
//     }

//     /**
//      * Register a newly created driver.
//      */
//     public function store(StoreDriverRequest $request)
//     {
//         try {
//             $driver = Driver::create([
//                 'username' => $request->username,
//                 'license_number' => $request->license_number,
//                 'vehicle_type' => $request->vehicle_type,
//                 'password' => Hash::make($request->password),
//                 'availability' => $request->availability,
//             ]);
//             return $this->customeResponse($driver, 'Driver registered successfully', 201);
//         } catch (\Throwable $th) {
//             Log::error('Error registering driver: ' . $th->getMessage());
//             return($th);
//             return $this->customeResponse(null, "Error registering driver", 500);
//         }
//     }

  

//     /**
//      * Log in a driver and return a JWT token.
//      */
//     public function login(LoginRequest $request)
//     {
//         $credentials = $request->only('username', 'password');

//         try {
//             if (!$token = JWTAuth::attempt($credentials)) {
//                 return $this->customeResponse(null, 'Unauthorized', 401);
//             }
//         } catch (JWTException $e) {
//             return $this->customeResponse(null, 'Could not create token', 500);
//         }

//         return $this->customeResponse(compact('token'), 'Login successful', 200);
//     }

//     /**
//      * Log out the driver and invalidate the token.
//      */
//     public function logout(Request $request)
//     {
//         try {
//             JWTAuth::invalidate(JWTAuth::getToken());
//             return $this->customeResponse(null, 'Successfully logged out', 200);
//         } catch (JWTException $e) {
//             return $this->customeResponse(null, 'Could not invalidate token', 500);
//         }
//     }

//     /**
//      * Display the specified driver.
//      */
//     public function show(Driver $driver)
//     {
//         try {
//             return $this->customeResponse($driver, 'Driver retrieved successfully', 200);
//         } catch (\Throwable $th) {
//             Log::error('Error retrieving driver: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error retrieving driver", 500);
//         }
//     }

//     /**
//      * Update the specified driver in storage.
//      */
//     public function update(UpdateDriverRequest $request, Driver $driver)
//     {
//         try {
//             $driver->update($request->validated());
//             return $this->customeResponse($driver, 'Driver updated successfully', 200);
//         } catch (\Throwable $th) {
//             Log::error('Error updating driver: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error updating driver", 500);
//         }
//     }

//     /**
//      * Remove the specified driver from storage.
//      */
//     public function destroy(Driver $driver)
//     {
//         try {
//             $driver->delete();
//             return $this->customeResponse(null, 'Driver deleted successfully', 200);
//         } catch (\Throwable $th) {
//             Log::error('Error deleting driver: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error deleting driver", 500);
//         }
//     }
// }
