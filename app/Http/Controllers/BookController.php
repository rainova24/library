<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\BookInstance; // Make sure to include this if you use BookInstance in the stats
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class BookController extends Controller
{
    /**
     * Only logged in users can have access
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort') && $request->sort === 'category') {
            $query->leftJoin('categories', 'books.category_id', '=', 'categories.id')
                ->orderBy('categories.name', $request->direction === 'desc' ? 'desc' : 'asc');
        } elseif ($request->has('sort') && in_array($request->sort, ['name', 'author', 'publication_date'])) {
            $query->orderBy($request->sort, $request->direction === 'desc' ? 'desc' : 'asc');
        } else {
            $query->latest();
        }

        $books = $query->paginate(15);

        return view('books.index', compact('books'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('books.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->publication_date = $request->publication_date;
        $book->category_id = $request->category_id; // Perhatikan ini
        $book->save();

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('books.edit')->with([
            'book' => $book,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|max:255',
            'author' => 'required|max:255',
            'publication_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update the book record using validated data
        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    /**
     * Get dashboard statistics.
     *
     * @return array
     */
    public function getDashboardStats()
    {
        return [
            'total_books' => Book::count(),
            'available_books' => BookInstance::where('is_available', true)->count(),
            'borrowed_books' => BookInstance::where('is_available', false)->count(),
        ];
    }

    public function export()
    {
        // return Excel::download(new BooksExport, 'books.xlsx');
    }
}
