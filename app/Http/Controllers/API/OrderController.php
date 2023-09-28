<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Order;
use App\Models\User;
use App\Models\Book;

class OrderController extends Controller
{

    // Get all the order
    public function index()
    {
        $orders = Order::all();
    
        return response()->json(['data' => $orders], 200);
    }


    // Get the order by id
    public function show(string $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        return response()->json(['data' => $order], 200);
    }
    

    // Generate the order
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'title' => 'required|string',
            'address' => 'string|nullable',
            'phone_number' => 'required|integer',
            'quantity' => 'required|integer',
            'each_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'order_status' => 'nullable|string|in:delivered,pending', 
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }
        
        $user = User::where('name', $request->name)->first();
        $book = Book::where('title', $request->title)->first();
        
        if (!$user || !$book) {
            return response()->json(['error' => 'User or book not found'], 404);
        }

    if ($request->input('order_status') === 'delivered') {
        $request->merge(['order_status' => 'delivered']);
    } else {
        $request->merge(['order_status' => 'pending']);
    }
        // Create the order
        $order = new Order($request->all());
        $order->save();
        return response()->json(['message' => 'Order created successfully', 'data' => $order], 201);
        
    }
    
/// Update order
public function update(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'string',
        'title' => 'string',
        'address' => 'string|nullable',
        'phone_number' => 'integer',
        'quantity' => 'integer',
        'each_price' => 'numeric',
        'total_price' => 'numeric',
        'order_date' => 'date',
        'delivery_date' => 'date',
        'order_status' => 'string|in:delivered,pending',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => 'Validation failed', 'errors' => $validator->errors()], 400);
    }

    $order = Order::find($id);
    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }
    if ($request->has('name')) {
        $order->name = $request->input('name');
    }
    if ($request->has('title')) {
        $order->title = $request->input('title');
    }
    if ($order->save()) {
        return response()->json(['message' => 'Order updated successfully', 'data' => $order], 200);
    } else {
        return response()->json(['error' => 'Failed to update the order'], 500);
    }
}


    // Delete order
    public function destroy(string $id)
{
    $order = Order::find($id);
    if (!$order) {
        return response()->json(['message' => 'Order item not found'], 404);
    }
    $order->delete();
    return response()->json(['message' => 'Oreder deleted successfully']);
        
}
}