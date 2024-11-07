<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="flex flex-col py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4">
                <form action="{{ route('books.index') }}" method="GET">
                    <input type="text" name="search" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md"
                        placeholder="Search books..."
                        value="{{ request('search') }}">
                </form>
            </div>

            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <table class="min-w-full">
                    <thead class="bg-gray-800 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-sm font-medium text-center text-white">
                                <a href="{{ route('books.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                    Name
                                    @if(request('sort') === 'name')
                                        <i class="fas fa-sort-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-4 text-sm font-medium text-center text-white">
                                <a href="{{ route('books.index', ['sort' => 'author', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                    Author
                                    @if(request('sort') === 'author')
                                        <i class="fas fa-sort-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-4 text-sm font-medium text-center text-white">
                                <a href="{{ route('books.index', ['sort' => 'publication_date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                    Publication Date
                                    @if(request('sort') === 'publication_date')
                                        <i class="fas fa-sort-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-4 text-sm font-medium text-center text-white">
                                <a href="{{ route('books.index', ['sort' => 'category', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                    Category
                                    @if(request('sort') === 'category')
                                        <i class="fas fa-sort-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-4 text-sm font-medium text-center text-white">Edit</th>
                            <th scope="col" class="px-6 py-4 text-sm font-medium text-center text-white">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr class="transition duration-300 ease-in-out bg-white border-b hover:bg-gray-100">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                {{ $book->name }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                {{ $book->author }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                {{ date('Y-m-d', strtotime($book->publication_date)) }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                {{ $book->category->name }}</td>

                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <form action="{{ route('books.destroy', ['book' => $book]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $books->appends(request()->query())->links() }}
                <p class="text-sm text-gray-600 mt-2">
                    Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} entries
                </p>
            </div>
        </div>
    </div>
</x-app-layout>