<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libraries = \App\Models\Library::with('books')
            ->latest()
            ->paginate(3);

        return view('dashboard', ['libraries' => $libraries]);
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
        $validated = $request->validate(['name' => ['required', 'max:12']]);

        $library = new Library();

        $library->fill($validated);

        if ($library->save()) {
            return response()->json(['library' => $library, 'message' => 'You have added new library!', 'status' => 200], 200);
        }

        return response()->json(['message' => 'There\'s an error occurred', 'status' => 500], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function show(Library $library)
    {
        $books = Book::all();
        $booksInCurrentLibrary = $library->books()->latest()->paginate(10);

        return view('library.show', ['library' => $library, 'books' => $books, 'booksInCurrentLibrary' => $booksInCurrentLibrary]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $library)
    {
        $validated = $request->validate(['name' => 'required', 'book_ids' => '']);

        if (!empty($validated['book_ids'])) {
            $library->books()->syncWithoutDetaching($validated['book_ids']);
        }

        if ($library->update($validated)) {
            return redirect()
                ->back()
                ->with(['message' => 'You\'ve successfully updated library']);
        };

        return redirect()
            ->back()
            ->with(['message' => 'You\'ve successfully updated library']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        if ($library->delete()) {
            return response()->json(['library' => $library, 'message' => 'You have deleted a library!', 'status' => 200], 200);
        }

        return response()->json(['message' => 'There\'s an error occurred', 'status' => 500], 500);
    }
}
