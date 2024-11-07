<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BookInstance;
use Livewire\WithPagination;

class BookInstanceList extends Component
{
    use WithPagination;

    public $status = 'all';

    // Refresh component when status is changed in BookInstanceAvailability component
    protected $listeners = ['statusChanged' => '$refresh'];

    public function updatingStatus()
    {
        // Reset to first page when status filter changes
        $this->resetPage();
    }

    public function render()
    {
        // Build the query based on the selected status
        $query = BookInstance::query();

        if ($this->status === 'available') {
            $query->where('is_available', true);
        } elseif ($this->status === 'borrowed') {
            $query->where('is_available', false);
        }

        // Paginate the query results
        $book_instances = $query->paginate(15);

        // Return the view with paginated book instances
        return view('livewire.book-instance-list', [
            'book_instances' => $book_instances
        ]);
    }
}