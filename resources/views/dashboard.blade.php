<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
                <!-- Card 1 -->
                <div class="w-full px-4 py-5 bg-white rounded-lg shadow">
                    <div class="text-sm font-medium text-gray-500 truncate">
                        Total Books
                    </div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ \App\Models\Book::count() }}
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="w-full px-4 py-5 bg-white rounded-lg shadow">
                    <div class="text-sm font-medium text-gray-500 truncate">
                        Total Categories
                    </div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ \App\Models\Category::count() }}
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="w-full px-4 py-5 bg-white rounded-lg shadow">
                    <div class="text-sm font-medium text-gray-500 truncate">
                        Total Users
                    </div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ \App\Models\User::count() }}
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activities</h3>
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @foreach(\App\Models\BookInstance::latest()->take(5)->get() as $activity)
                        <li>
                            <div class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Book "{{ $activity->book->name }}" was {{ $activity->is_available ? 'returned by' : 'borrowed by' }} 
                                                <span class="font-medium text-gray-900">{{ $activity->borrower->name }}</span>
                                            </p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time>{{ $activity->created_at->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('books.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Add New Book
                        </a>
                        <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Add New Category
                        </a>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">System Status</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">System Status</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Last Updated</span>
                            <span class="text-gray-900">{{ now()->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>