<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Create a book
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|bail|string'
        ]);

    
        try {
            // Create new book
            Book::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description
            ]);
             // Response
             return response()->json([
                'message' => 'Success'
            ],200);
        } catch (\Throwable $th) {
             // Response
             return response()->json([
                'message' => 'Server Error'
            ],500);
        }
    }


    // Show single book a book
    public function show(Request $request)
    {
        // Return all books
        return Book::orderBy('id','desc')->select()->paginate(20);

    }
    // Show single book a book
    public function showSingle(Request $request, $id)
    {
        // Return single book with guven id
        return Book::where('id',$id)->get();

    }

    // Delete a book
    public function destroy(Request $request, $id)
    {
        // Check if Book Exists
        if(Book::where('id',$id)->exists()){
            // Delete Book
            Book::where('id',$id)->delete();

             // Response
             return response()->json([
                'message' => 'Success'
            ],200);
        } else {
            // Response
            return response()->json([
                'message' => 'Bad parameters'
            ],400);
        }

    }
}
