<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Seminar extends Component
{
    use WithPagination;

    public $search;
    public function render()
    {
        $events = Event::latest() ->where('type', 'seminar')->where('name', 'like', '%'.$this->search.'%')->paginate(2);
        return view('livewire.seminar', [
            'events' => $events
        ]);
    }
}
