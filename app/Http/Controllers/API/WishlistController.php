<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
    
        $book_id = $request->input('book_id');
        $user = auth()->user();
        if ($user->wishlistItems()->where('book_id', $book_id)->exists()) {
          
            $response = [
                'message' => 'Book is already in the wishlist',
                'book_id' => $book_id,
            ];
            return response()->json($response, 400); // Return a 400 Bad Request response
        }
    
        // Attach the book to the user's wishlist
        $user->wishlistItems()->attach($book_id);
    
        // Create a response array
        $response = [
            'message' => 'Item added to wishlist successfully',
            'book_id' => $book_id,
        ];
    
        // Return a JSON response
        return response()->json($response, 201); // Return a 201 Created response
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
