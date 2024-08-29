<?php

// namespace App\Http\Controllers;

// use App\Http\Requests\StoreOrderRequest;
// use App\Http\Requests\UpdateOrderRequest;
// use App\Http\Traits\ApiResponseTrait;
// use App\Models\Order;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Http\Request;

// class OrderController extends Controller
// {
//     use ApiResponseTrait;

//     /**
//      * Display a listing of the orders.
//      */
//     public function index()
//     {
//         try {
//             $orders = Order::all();
//             return $this->customeResponse($orders, "Orders retrieved successfully", 200);
//         } catch (\Throwable $th) {
//             Log::error('Error retrieving orders: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error retrieving orders", 500);
//         }
//     }

//     /**
//      * Store a newly created order in storage.
//      */
//     public function store(StoreOrderRequest $request)
//     {
//         try {
//             $order = Order::create($request->validated());
//             return $this->customeResponse($order, 'Order created successfully', 201);
//         } catch (\Throwable $th) {
//             Log::error('Error creating order: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error creating order", 500);
//         }
//     }

//     /**
//      * Display the specified order.
//      */
//     public function show($order_id)
//     {
//         try {
//             $order = Order::where('order_id', $order_id)->firstOrFail();
//             return $this->customeResponse($order, 'Order retrieved successfully', 200);
//         } catch (\Throwable $th) {
//             Log::error('Error retrieving order: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error retrieving order", 500);
//         }
//     }

//     /**
//      * Update the specified order in storage.
//      */
//     public function update(UpdateOrderRequest $request, $order_id)
//     {
//         try {
//             $order = Order::where('order_id', $order_id)->firstOrFail();
//             $order->update($request->validated());
//             return $this->customeResponse($order, 'Order updated successfully', 200);
//         } catch (\Throwable $th) {
//             Log::error('Error updating order: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error updating order", 500);
//         }
//     }

//     /**
//      * Remove the specified order from storage.
//      */
//     public function destroy($order_id)
//     {
//         try {
//             $order = Order::where('order_id', $order_id)->firstOrFail();
//             $order->delete();
//             return $this->customeResponse(null, 'Order deleted successfully', 200);
//         } catch (\Throwable $th) {
//             Log::error('Error deleting order: ' . $th->getMessage());
//             return $this->customeResponse(null, "Error deleting order", 500);
//         }
//     }
// }
namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
// use App\Http\Controllers\FurnitureController;
use App\Models\Furniture;

class OrderController extends Controller
{
    use ApiResponseTrait;

    // function __construct()
    // {
    //     $this->middleware(['permission:view-order'], ['only' => ['index,show']]);
    //     $this->middleware(['permission:complete-order'], ['only' => ['completeOrder']]);
    //     $this->middleware(['permission:update-order'], ['only' => ['update']]);
    //     $this->middleware(['permission:delete-order'], ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        try {
            $orders = Order::with('furniture')->get(); // إضافة العلاقة
            return $this->customeResponse($orders, "Orders retrieved successfully", 200);
        } catch (\Throwable $th) {
            Log::error('Error retrieving orders: ' . $th->getMessage());
            return $this->customeResponse(null, "Error retrieving orders", 500);
        }
    }
    

    /**
     * Store a newly created order in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            // إنشاء الطلب
            $order = Order::create($request->validated());
    
            // إضافة قطع الأثاث إلى الطلب
            $furnitureData = $request->input('furniture');
    
          
    
            return $this->customeResponse($order, 'Order created successfully', 201);
        } catch (\Throwable $th) {
            Log::error('Error creating order: ' . $th->getMessage());
            return $this->customeResponse(null, "Error creating order", 500);
        }
    }
    /**
     * Display the specified order.
     */
    public function show($order_id)
    {
        try {
            $order = Order::with('furniture')->where('order_id', $order_id)->firstOrFail();
            return $this->customeResponse($order, 'Order retrieved successfully', 200);
        } catch (\Throwable $th) {
            
            Log::error('Error retrieving order: ' . $th->getMessage());
            return $this->customeResponse(null, "Error retrieving order", 500);
        
        }
    }

    /**
     * Update the specified order in storage.
     */
    public function update(UpdateOrderRequest $request, $order_id)
    {
        try {
            $order = Order::where('order_id', $order_id)->firstOrFail();
            $order->update($request->validated());
            return $this->customeResponse($order, 'Order updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error('Error updating order: ' . $th->getMessage());
            return $this->customeResponse(null, "Error updating order", 500);
        }
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($order_id)
    {
        try {
            $order = Order::where('order_id', $order_id)->firstOrFail();
            $order->delete();
            return $this->customeResponse(null, 'Order deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error('Error deleting order: ' . $th->getMessage());
            return $this->customeResponse(null, "Error deleting order", 500);
        }
    }

    /**
     * Mark the order as completed by the driver.
     */
    public function completeOrder($order_id)
    {
        try {
            $order = Order::where('order_id', $order_id)->firstOrFail();
            $order->update(['status' => false]); // تعيين status إلى false عند إكمال الطلب
            return $this->customeResponse($order, 'Order completed successfully', 200);
        } catch (\Throwable $th) {
            Log::error('Error completing order: ' . $th->getMessage());
            return $this->customeResponse(null, "Error completing order", 500);
        }
    }
}
