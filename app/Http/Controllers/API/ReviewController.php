<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;


class ReviewController extends Controller
{
    
    // Create review
    public function index()
   {
       $reviews = Review::all();
       return response(['message' => 'Retrived all reviews  successfully', 'book' => $reviews]);
   }
     
     // Add review
     public function store(Request $request)
{
    $existingReview = Review::where('user_id', $request->user_id)
        ->where('book_id', $request->book_id)
        ->first();

    if ($existingReview) {
        return response()->json(['message' => 'User has already reviewed this book'], 422);
    }
    $review = Review::create($request->all());
    $rating = Review::where('book_id', $request->book_id)->avg('rating');
    Book::where('id', $request->book_id)->update(['rating' => $rating]);

    return response()->json(['message' => 'Review added successfully', 'review' => $review, 'average_rating' => $rating], 201);
}

     
//  Update 
   public function update(Request $request, $review_id)
{
    $request->validate([
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',

    ]);

    $existingReview = Review::find($review_id);
    if (!$existingReview) {
        return response()->json(['message' => 'Review not found'], 404);
    }
    $existingReview->update([
        'review' => $request->input('review'),
        'rating' => 'required|integer|min:1|max:5',

    ]);

    return response()->json(['message' => 'Review text updated successfully', 'review' => $existingReview], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
