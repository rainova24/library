<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit a category') }}
        </h2>
        <style>
            input[type=text],
            select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=submit] {
                width: 100%;
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }

            div.edit {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="edit">
                    <form method="POST" action=" {{ route('categories.update', ['category' => $category]) }}">
                        @csrf
                        @method('PATCH')

                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value='{{ $category->name }}'>

                        <label for="name">Description</label>
                        <input type="text" id="description" name="description" value='{{ $category->description }}'>

                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
