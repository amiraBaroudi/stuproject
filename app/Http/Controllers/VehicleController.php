<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    use ApiResponseTrait;

    // function __construct()
    // {
    //     $this->middleware(['permission:view-vehicle'], ['only' => ['index,show']]);
    //     $this->middleware(['permission:create-vehicle'], ['only' => ['store']]);
    //     $this->middleware(['permission:update-vehicle'], ['only' => ['update']]);
    //     $this->middleware(['permission:delete-vehicle'], ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $vehicles = Vehicle::all();
            return $this->customeResponse($vehicles, "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        try {
            $vehicle = Vehicle::create($request->validated());
            return $this->customeResponse($vehicle, 'Vehicle created successfully', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Display the specified resource.
     */

   
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        try {
            $vehicle->update($request->validated());
            return $this->customeResponse($vehicle, 'Vehicle updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            $vehicle->delete();
            return $this->customeResponse("", 'Vehicle deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
}
