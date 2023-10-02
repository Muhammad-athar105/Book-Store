<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Book;
use Auth;

class WishlistController extends Controller
{   
    // Get All wishlist
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return response()->json($wishlist);

    }

    // Add wish list 
    public function addWishList(Request $request)
    {
       if(Auth::check())
       {
        $book_id = $request->input( 'book_id' );
        if (Book::find($book_id)) 
        {
            $wish = new Wishlist();
            $wish->book_id=$book_id;
            $wish->user_id = Auth::id();
            $wish->save();
            return response()->json(['status' => 'Book added to wish list']);
        } else {
            return response()->json(['status' => 'Book does not exist']);
        } 
       }else {
        return response()->json(['status' => 'Login to continue']);
       }
    }

    // Delete wish list
    public function deleteWishList(Request $request)
    {
        if (Auth::check()) {
            $book_id = $request->input('book_id');  
            if (Wishlist::where('book_id', $book_id)->where('user_id', Auth::id())->exists()) {
                $wish = Wishlist::where('book_id', $book_id)->where('user_id', Auth::id())->delete();
                // $wish->delete();
                return response()->json(['status' => 'Wish List item deleted']);
            } else {
                return response()->json(['status' => 'Wish List item not found']);
            }
        } else {
            return response()->json(['status' => 'Login to continue']);
        }
    }
    
}