<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BookInstance;

class UpdateAvailability extends Component
{
    public $book_instance;
    public $instance;
    public $confirmChange = false;

    public function render()
    {
        return view('livewire.update-availability');
    }

    /**
     * Changes the status Availability of a book instance
     * If status is 0 (Not Available) changes to 1 (Available)
     * and viceversa.
     */
    public function changeAvailability(BookInstance $book_instance, $status)
    {
        $book_instance->is_available = !$status;
        $book_instance->save();
        
        // Log perubahan
        \Log::info('Book Instance ID: ' . $book_instance->id . ' availability changed to: ' . (!$status));
    }
}
