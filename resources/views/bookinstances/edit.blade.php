<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Book Copy') }}
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

            input[type=submit], button {
                width: 100%;
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover, button:hover {
                background-color: #45a049;
            }

            div.edit {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }

            input[type="checkbox"] {
                width: 1.2em;
                height: 1.2em;
                margin-right: 0.5em;
                vertical-align: middle;
                position: relative;
                top: -1px;
            }

            .checkbox-container {
                display: flex;
                align-items: center;
                margin: 10px 0;
                padding: 5px 0;
            }

            input[type="checkbox"] + span {
                font-size: 1rem;
                color: #4a5568;
            }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('bookinstances.update', $book_instance) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-6">
                        <!-- Books dropdown -->
                        <div>
                            <label for="book">Books</label>
                            <select name="book_id" id="book" class="w-full mt-1 rounded-md">
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" 
                                        {{ $book_instance->book_id == $book->id ? 'selected' : '' }}>
                                        {{ $book->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Borrower dropdown -->
                        <div>
                            <label for="borrower">Borrower</label>
                            <select name="borrower_id" id="borrower" class="w-full mt-1 rounded-md">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $book_instance->borrower_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Single Availability checkbox -->
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" 
                                    name="is_available" 
                                    class="form-checkbox"
                                    value="1" 
                                    {{ $book_instance->is_available ? 'checked' : '' }}>
                                <span class="ml-2">Available</span>
                            </label>
                        </div>

                        <!-- Due Back Date -->
                        <div>
                            <label for="due_back">Due Back Date</label>
                            <input type="date" 
                                name="due_back" 
                                id="due_back" 
                                value="{{ $book_instance->due_back }}" 
                                class="w-full mt-1 rounded-md">
                        </div>

                        <div class="mt-6">
                            <button type="submit" 
                                    class="w-full p-3 text-white bg-green-500 rounded-md hover:bg-green-600">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>