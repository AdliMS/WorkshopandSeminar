<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventList extends Component
{
    use WithPagination;

    public $search;
    public function render()
    {
        $events = Event::latest()->where('name', 'like', '%'.$this->search.'%')->paginate(2);
        return view('livewire.event-list', [
            'events' => $events
        ]);
    }
}
