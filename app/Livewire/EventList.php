<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventList extends Component
{
    use WithPagination;

    public function render()
    {
        $events = Event::latest()->paginate(2);
        
        return view('livewire.event-list', [
            'events' => $events
        ]);
    }
}
