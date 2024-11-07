<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BookInstance;

class BookInstanceAvailability extends Component
{
    public $instance;
    public $isAvailable;
    public $confirmChange = false;

    public function mount(BookInstance $instance)
    {
        $this->instance = $instance;
        $this->isAvailable = $instance->is_available;
    }

    public function render()
    {
        return view('livewire.book-instance-availability');
    }

    public function changeAvailability()
    {
        $this->confirmChange = false;
        $this->instance->is_available = !$this->instance->is_available;
        $this->instance->save();

        $this->isAvailable = $this->instance->is_available;
    }
}
