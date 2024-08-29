<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFurnitureRequest;
use App\Http\Requests\UpdateFurnitureRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Furniture;
use Illuminate\Support\Facades\Log;

class FurnitureController extends Controller
{
    use ApiResponseTrait;

    // function __construct()
    // {
    //     $this->middleware(['permission:create-furniture'], ['only' => ['index,show']]);
    //     $this->middleware(['permission:create-furniture'], ['only' => ['store']]);
    //     $this->middleware(['permission:update-furniture'], ['only' => ['update']]);
    //     $this->middleware(['permission:delete-furniture'], ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $furnitures = Furniture::with('orders')->get(); // إضافة العلاقة إذا لزم الأمر
            return $this->customeResponse($furnitures, "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFurnitureRequest $request)
    {
        try {
            $furniture = Furniture::create($request->validated());
            return $this->customeResponse($furniture, 'Furniture created successfully', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Display the specified resource.
    */
    // public function show(Furniture $furniture)
    // {
    //     try {
    //         return $this->customeResponse($furniture, 'Done', 200);
    //     } catch (\Throwable $th) {
    //         Log::error($th);
    //         return $this->customeResponse(null, "Error, Something went wrong", 500);
    //     }
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFurnitureRequest $request, Furniture $furniture)
    {
        try {
            $furniture->update($request->validated());
            return $this->customeResponse($furniture, 'Furniture updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Furniture $furniture)
    {
        try {
            $furniture->delete();
            return $this->customeResponse("", 'Furniture deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
}
