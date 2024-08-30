<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Driver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the drivers.
     */
    public function index()
    {
        try {
            // Attempt to retrieve all drivers
            $drivers = Driver::all();

            // Check if drivers were retrieved
            if ($drivers->isEmpty()) {
                return $this->customeResponse(null, "No drivers found", 404);
            }

            return $this->customeResponse($drivers, "Drivers retrieved successfully", 200);
        } catch (\Throwable $th) {
            // Log detailed error message
            Log::error('Error retrieving drivers: ' . $th->getMessage() . ' | Trace: ' . $th->getTraceAsString());

            // Provide more detailed error message in response
            return $this->customeResponse(null, "Error retrieving drivers: " . $th->getMessage(), 500);
        }
    }

    /**
     * Store a newly created driver.
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
            Log::error('Error creating driver: ' . $th->getMessage() . ' | Trace: ' . $th->getTraceAsString());
            return $this->customeResponse(null, "Error creating driver: " . $th->getMessage(), 500);
        }
    }

    /**
     * Display the specified driver.
     */
    public function show(Driver $driver)
    {
        try {
            return $this->customeResponse($driver, 'Driver retrieved successfully', 200);
        } catch (\Throwable $th) {
            Log::error('Error retrieving driver: ' . $th->getMessage() . ' | Trace: ' . $th->getTraceAsString());
            return $this->customeResponse(null, "Error retrieving driver: " . $th->getMessage(), 500);
        }
    }

    /**
     * Update the specified driver.
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
            Log::error('Error updating driver: ' . $th->getMessage() . ' | Trace: ' . $th->getTraceAsString());
            return $this->customeResponse(null, "Error updating driver: " . $th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified driver.
     */
    public function destroy(Driver $driver)
    {
        try {
            $driver->delete();
            return $this->customeResponse(null, 'Driver deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error('Error deleting driver: ' . $th->getMessage() . ' | Trace: ' . $th->getTraceAsString());
            return $this->customeResponse(null, "Error deleting driver: " . $th->getMessage(), 500);
        }
    }

    /**
     * Log in a driver and return a token.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
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

    /**
     * Register a new user and return a token.
     */
    public function register(Request $request)
    {
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

    /**
     * Log out the current user.
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
