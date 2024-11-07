<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Add New Category') }}
            </a>
        </div>
        <style>
            #categories {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #categories td,
            #categories th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #categories tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #categories tr:hover {
                background-color: #ddd;
            }

            #categories th {
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

                <table id="categories">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>

                            <td><a href="{{ url('categories/' . $category->id . '/edit') }}">Edit</a></td>
                            <td>
                                <form action="{{ route('categories.destroy', ['category' => $category]) }}"
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
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>