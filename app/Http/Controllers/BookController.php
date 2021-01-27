<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'max:70'],
                'author' => 'required',
                'year_published' => 'required'
            ]);

        $book = new Book();
        $book->fill($validated);

        if ($book->save()) {

            $book->libraries()->syncWithoutDetaching([$request->library_id]);

            return response()->json(['library' => $book, 'message' => 'You have added new library!', 'status' => 200], 200);
        }

        return response()->json(['message' => 'There\'s an error occurred', 'status' => 500], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year_published' => 'required'
        ]);

        if ($book->update($validated)) {
            return redirect()->back()->with(['book' => $book, 'message' => 'You have successfully updated this book!', 'status' => 200]);
        }

        return redirect()->back()->with(['message' => 'There\'s an error occurred', 'status' => 500]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->delete()) {
            return response()->json(['book' => $book, 'message' => 'You have deleted a book!', 'status' => 200, 'redirect_url' => route('dashboard')], 200);
        }

        return response()->json(['message' => 'There\'s an error occurred', 'status' => 500], 500);
    }
}
