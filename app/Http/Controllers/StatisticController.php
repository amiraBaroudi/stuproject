<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatisticRequest;
use App\Http\Requests\UpdateStatisticRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Statistic;
use Illuminate\Support\Facades\Log;

class StatisticController extends Controller
{
    use ApiResponseTrait;

    // function __construct()
    // {
    //     $this->middleware(['permission:create-statistic'], ['only' => ['store']]);
    //     $this->middleware(['permission:update-statistic'], ['only' => ['update']]);
    //     $this->middleware(['permission:delete-statistic'], ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $statistics = Statistic::all();
            return $this->customeResponse($statistics, "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatisticRequest $request)
    {
        try {
            $statistic = Statistic::create($request->validated());
            return $this->customeResponse($statistic, 'Statistic created successfully', 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return ($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Statistic $statistic)
    {
        try {
            return $this->customeResponse($statistic, 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatisticRequest $request, Statistic $statistic)
    {
        try {
            $statistic->update($request->validated());
            return $this->customeResponse($statistic, 'Statistic updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic)
    {
        try {
            $statistic->delete();
            return $this->customeResponse("", 'Statistic deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
}
