<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Book;
use App\Models\Review;

class BookController extends Controller
{
   
    // get all Books
   public function index()
   {
       $books = Book::all();
       $review = Review::all();
       return response(['message' => 'Retrived all books successfully', 'book' => $books]);
   }

       // create a new product
       public function store(Request $request)
       {
           $input = $request->all();
           $validator = Validator::make($input, [
               'title' => 'required',
               'author' => 'required',
               'description' => 'required',
               'price' => 'required',
               'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           ]);
           $image_path = $request->file('image')->store('image', 'public');

           if($validator->fails()){
            return response()->json(['message' => 'Validation Failed', 'errors' => $validator->errors()], 422);
           }
           
       if ($request->hasFile('image')) {
           $image = $request->file('image');
           $imageName = time().'.'.$image->getClientOriginalExtension();
           $imagePath = $image->storeAs('images', $imageName, 'public');
           $input['image'] = $imagePath; 
           
       }
           
           $book = Book::create($input);
           return response()->json(['message' => 'Book created successfully.', 'user' => $book], 201);
       } 
 

    //  Get the Book By ID
    public function show($id)
    {
        $book = Book::with('reviews.user')->findOrFail($id);
        $review = $book->review;
        // $averageRating = $book->review->avg('rating');
        $data = [
            'book' => $book,
            'review' => $review,
        ];
        return response()->json($data);
    }
    
    
    // update by by id
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation Failed', 'errors' => $validator->errors()], 422);
        }
        $input = $request->only(['title', 'author', 'description', 'price']);
    
        // Handle image upload and update the book's image field
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $input['image'] = $imagePath;
        }
    
        $book->update($input);
    
        return response(['message' => 'Book updated successfully', 'book' => $book]);
    }


    // delete a book
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found.'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully.']);
    }
    
    
}
