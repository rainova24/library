<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Book Copies') }}
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
                <form method="GET" action="{{ route('bookinstances.index') }}">
                    <div class="mb-4 p-4">
                        <select name="status" onchange="this.form.submit()" class="px-4 py-2 border rounded">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                        </select>
                        <!-- Tambahkan tombol submit -->
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Filter
                        </button>
                    </div>
                </form>

                @if (count($book_instances) <= 0)
                    <p class="p-4">No records found</p>
                @else
                    <table id="books">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Borrower</th>
                                <th>Due Back Date</th>
                                <th>Availability</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($book_instances as $instance)
                                <tr>
                                    <td>{{ $instance->book->name }}</td>
                                    <td>{{ $instance->borrower->name ?? 'N/A' }}</td>
                                    <td>{{ $instance->due_back ?? 'N/A' }}</td>
                                    <td>
                                        {{ $instance->is_available ? 'Available' : 'Not Available' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('bookinstances.edit', $instance->id) }}" 
                                        class="text-blue-600 hover:text-blue-800">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('bookinstances.destroy', $instance->id) }}" 
                                            method="POST" 
                                            onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            {{ $book_instances->appends(['status' => request('status')])->links() }}
        </div>
    </div>

    <script>
        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this item?')) {
                event.preventDefault();
            }
        }
    </script>
</x-app-layout>