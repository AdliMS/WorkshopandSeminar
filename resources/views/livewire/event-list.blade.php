<div class="flex flex-col justify-center items-center gap-8">

        @foreach ($events as $event)
                <div class="overflow-hidden flex items-center gap-8 w-3/4 bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-all">

                    {{-- Link to individual event --}}
                    <a class="w-1/2" href="event/{{ $event->id }}">
                        <img class="" src="{{ asset('assets/img/event.jpg') }}" alt="" />
                    </a>

                    <div class="flex flex-col w-full">

                        {{-- Link to individual event --}}
                        <a href="event/{{ $event->id }}">
                            <h5 class="mb-1 text-2xl font-md tracking-tight text-[#3A6D8C] hover:underline">{{ $event->name }}</h5>
                        </a>

                        <p class="mb-3 text-sm font-normal text-gray-700">Diselenggarakan oleh: Komunitas Pangkalan Besi</p>
                        <p class="my-6 font-normal text-gray-700">{{ $event->description }}</p>

                        <ul class="text-sm mb-3 ml-8 font-normal text-gray-700">
                            <li>Mulai: {{ Carbon\Carbon::parse($event->start_time)->format('j F o') }}</li>
                            <li>Lokasi: {{ $event->venue }}</li>
                            <li>Sisa Kuota: {{ $event->max_participants - $event->current_participants }}</li>
                        </ul>
                        
                    </div>
                </div>        
            @endforeach
            
        {{ $events->links() }}
</div>
