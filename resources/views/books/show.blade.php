<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Book') }}
        </h2>
        <style>
            #books {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #books td,
            #books th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #books tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #books tr:hover {
                background-color: #ddd;
            }

            #books th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #04AA6D;
                color: white;
            }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <table id="books">
                    <tr>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Publication Date</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <tr>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publication_date->format('Y-m-d') }}</td>
                        <td>{{ $book->category->name }}</td>

                        <td><a href="{{ url('books/' . $book->id . '/edit') }}">Edit</a></td>
                        <td>
                            <form action="{{ route('books.destroy', ['book' => $book]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @if (count($book->book_instances) <= 0)
                    <p>No records found</p>
                @endif

                <table id="books">
                    <tr>
                        <th>Book</th>
                        <th>Borrower</th>
                        <th>Due Back Date</th>
                        <th>Availability</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach ($book->book_instances as $instance)
                        <tr>
                            <td>{{ $instance->book->name }}</td>
                            <td>{{ $instance->borrower->name }}</td>
                            <td>{{ $instance->due_back }}</td>
                            <td>{{ $instance->is_available ? 'Available' : 'Not Available' }}</td>

                            <td><a href="{{ url('bookinstances/' . $instance->id . '/edit') }}">Edit</a></td>
                            <td>
                                <form action="{{ route('bookinstances.destroy', ['bookinstance' => $instance]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
