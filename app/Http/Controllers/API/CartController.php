<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\CartRequest;
use App\Http\Helpers\Helper;
use App\Models\Book;
use App\Models\Review;
use App\Models\Cart;


class CartController extends Controller
{
    // Get all Cart 
    public function getAll(CartRequest $request)
{
    $user_id = $request->input('user_id');
    $cartItems = Cart::where('user_id', $user_id)->get();
    return response()->json(['cart_items' => $cartItems]);
}

    // Add item to cart
    public function add(CartRequest $request)
    {
        $cartItem = Cart::where('user_id', $request->input('user_id'))
            ->where('book_id', $request->input('book_id'))
            ->first();
        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity');
            $cartItem->total_price = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
            return response()->json(['message' => 'Cart item updated successfully']);
        } 
        else {
            $totalPrice = $request->input('quantity') * $request->input('price');
            Cart::create([
                'user_id' => $request->input('user_id'),
                'book_id' => $request->input('book_id'),
                'title' => $request->input('title'),
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price'),
                'image' => $request->input('image'),
                'total_price' => $totalPrice, 
            ]);
            return response()->json(['message' => 'Cart item created successfully'], 201);
        }
    }
    
    // Delete
    public function delete($id)
{
    $cartItem = Cart::find($id);
    if (!$cartItem) {
        return response()->json(['message' => 'Cart item not found'], 404);
    }
    $cartItem->delete();
    return response()->json(['message' => 'Cart item deleted successfully']);
}

}

