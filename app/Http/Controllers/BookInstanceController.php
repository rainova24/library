<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BookInstance;
use Illuminate\Http\Request;

class BookInstanceController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = BookInstance::with(['book', 'borrower']);
        
        switch($status) {
            case 'available':
                $query->where('is_available', true);
                break;
            case 'borrowed':
                $query->where('is_available', false);
                break;
            default:
                // 'all' - tidak perlu filter
                break;
        }
        
        // Debug query
        \Log::info('SQL Query: ' . $query->toSql());
        \Log::info('Query Bindings: ', $query->getBindings());

        $book_instances = $query->paginate(15);

        // Debug results
        \Log::info('Total Results: ' . $book_instances->total());
        
        return view('bookinstances.index', [
            'book_instances' => $book_instances,
            'current_status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        $users = User::all();

        return view('bookinstances.create')->with([
            'books' => $books,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book_instance = new BookInstance();

        $book_instance->due_back = $request->due_back;
        $book_instance->is_available = $request->is_available;
        $book_instance->book_id = $request->books;
        $book_instance->borrower_id = $request->users;
        $book_instance->save();

        return redirect()->route('bookinstances.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookInstance  $bookInstance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book_instance = BookInstance::findOrFail($id);

        return view('bookinstances.show')->with('instance', $book_instance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookInstance  $bookInstance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book_instance = BookInstance::findOrFail($id);
        $books = Book::all();
        $users = User::all();

        return view('bookinstances.edit')->with([
            'book_instance' => $book_instance,
            'books' => $books,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookInstance  $bookInstance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookInstance $book_instance)
    {
        // Validasi data dari request
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrower_id' => 'required|exists:users,id',
            'due_back' => 'nullable|date',
            'is_available' => 'boolean',
        ]);

        // Tambahkan log untuk memeriksa data yang diterima
        \Log::info('Update Request Data:', $request->all());

        // Mengatur nilai is_available sesuai checkbox
        $isAvailable = $request->has('is_available') ? true : false;

        // Melakukan update pada book_instance
        $book_instance->update([
            'book_id' => $validated['book_id'],
            'borrower_id' => $validated['borrower_id'],
            'due_back' => $validated['due_back'],
            'is_available' => $isAvailable,
        ]);

        // Tambahkan log untuk memeriksa data yang telah divalidasi
        \Log::info('Validated Data:', $validated);

        // Tambahkan log untuk memeriksa data yang telah diperbarui
        \Log::info('Updated Book Instance:', $book_instance->toArray());

        return redirect()->route('bookinstances.index')
            ->with('success', 'Book instance updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookInstance  $bookInstance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book_instance = BookInstance::findOrFail($id);
        $book_instance->delete();

        return redirect()->route('bookinstances.index');
    }
}