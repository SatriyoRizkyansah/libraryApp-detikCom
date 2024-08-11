<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Auther;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorebookRequest;
use App\Http\Requests\UpdatebookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoryId = $request->query('category_id'); // Get the category ID from the query parameter

        $books = Book::when($categoryId, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })->paginate(5);

        $categories = Category::all(); // Get all categories for the filter dropdown

        return view('book.index', [
            'books' => $books,
            'categories' => $categories, // Pass categories to the view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'authors' => Auther::latest()->get(),
            'publishers' => Publisher::latest()->get(),
            'categories' => Category::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebookRequest  $request
     * @return \Illuminate\Http\Response
     */
//     public function store(StorebookRequest $request)
// {
//     $data = $request->validated();

//     if ($request->hasFile('cover')) {
//         $file = $request->file('cover');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $path = $file->storeAs('covers', $filename, 'public');
//         $data['cover'] = $path;
//     }

//     // Create a new book with the validated data and cover path
//     Book::create($data + ['status' => 'Y']);

//     return redirect()->route('books');
// }

public function store(StorebookRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('covers', $filename, 'public');
        $data['cover'] = $path;
    }

    if ($request->hasFile('pdf')) {
        $file = $request->file('pdf');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('pdfs', $filename, 'public');
        $data['pdf'] = $path;
    }

    Book::create($data + ['status' => 'Y']);

    return redirect()->route('books');
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'authors' => Auther::latest()->get(),
            'publishers' => Publisher::latest()->get(),
            'categories' => Category::latest()->get(),
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebookRequest  $request
     * @param  \App\Models\Book  $book
     * @return Response
     */
    public function update(UpdateBookRequest $request, Book $book)
{
    $data = $request->validated();

    // Handle the file upload
    if ($request->hasFile('cover')) {
        // Delete the old cover if a new one is uploaded
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $path = $request->file('cover')->store('covers', 'public');
        $data['cover'] = $path;
    }

    // Update the book with the correct column names
    $book->update([
        'name' => $data['name'],
        'auther_id' => $data['author_id'],
        'category_id' => $data['category_id'],
        'publisher_id' => $data['publisher_id'],
        'cover' => $data['cover'] ?? $book->cover, // Keep existing cover if not updated
    ]);

    return redirect()->route('book.index')->with('success', 'Book updated successfully.');
}

// public function update(UpdateBookRequest $request, Book $book)
// {
//     // Debugging
//     dd($request->all()); // Debug request data

//     $data = $request->validated();

//     // Handle the cover file upload
//     if ($request->hasFile('cover')) {
//         // Delete the old cover if a new one is uploaded
//         if ($book->cover) {
//             Storage::disk('public')->delete($book->cover);
//         }
//         $path = $request->file('cover')->store('covers', 'public');
//         $data['cover'] = $path;
//     }

//     // Handle the PDF file upload
//     if ($request->hasFile('pdf')) {
//         // Delete the old PDF if a new one is uploaded
//         if ($book->pdf) {
//             Storage::disk('public')->delete($book->pdf);
//         }
//         $path = $request->file('pdf')->store('pdfs', 'public');
//         $data['pdf'] = $path;
//     }

//     // Update the book with the correct column names
//     $book->update([
//         'name' => $data['name'],
//         'auther_id' => $data['auther_id'],
//         'category_id' => $data['category_id'],
//         'publisher_id' => $data['publisher_id'],
//         'cover' => $data['cover'] ?? $book->cover, // Keep existing cover if not updated
//         'pdf' => $data['pdf'] ?? $book->pdf, // Keep existing PDF if not updated
//     ]);

//     return redirect()->route('book.index')->with('success', 'Book updated successfully.');
// }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
        {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }

            $book->delete();

            return redirect()->route('book.index')->with('success', 'Book deleted successfully.');
        }

        }