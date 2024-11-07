@extends('layouts.app')

@section('content')
<div>
    <table id="books" class="w-full table-auto">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Book Name</th>
                <th class="px-4 py-2">Borrower</th>
                <th class="px-4 py-2">Due Back</th>
                <th class="px-4 py-2">Availability</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($book_instances as $instance)
                <tr>
                    <td class="border px-4 py-2">{{ $instance->book->name }}</td>
                    <td class="border px-4 py-2">{{ $instance->borrower->name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $instance->due_back }}</td>
                    <td class="border px-4 py-2">
                        @livewire('book-instance-availability', ['instance' => $instance], key($instance->id))
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $book_instances->links() }}
    </div>
</div>
@endsection
