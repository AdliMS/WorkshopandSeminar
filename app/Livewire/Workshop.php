<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Workshop extends Component
{
    use WithPagination;

    public $search;
    public function render()
    {
        $events = Event::latest() ->where('type', 'workshop')->where('name', 'like', '%'.$this->search.'%')->paginate(2);
        return view('livewire.seminar', [
            'events' => $events
        ]);
    }
}
