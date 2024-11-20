
<x-guest.layout>


    <section class="flex justify-center p-8 gap-8 flex-wrap bg-white w-full ">

        @foreach ($seminars as $seminar)
                <div class="max-w-2xl min-h-fit bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-all">

                    {{-- Link to individual event --}}
                    <a href="seminar/{{ $seminar->id }}">
                        <img class="rounded-t-lg" src="{{ asset('assets/img/event.jpg') }}" alt="" />
                    </a>

                    <div class="p-5">

                        {{-- Link to individual event --}}
                        <a href="seminar/{{ $seminar->id }}">
                            <h5 class="mb-1 text-3xl font-md tracking-tight text-[#3A6D8C] hover:underline">{{ $seminar->name }}</h5>
                        </a>

                        <p class="mb-3 text-sm font-normal text-gray-700">Diselenggarakan oleh: Komunitas Pangkalan Besi</p>
                        <p class="my-6 font-normal text-gray-700">{{ $seminar->description }}</p>

                        <ul class="text-sm mb-3 ml-8 font-normal text-gray-700">
                            <li>Mulai: {{ Carbon\Carbon::parse($seminar->start_time)->format('j F o') }}</li>
                            <li>Lokasi: {{ $seminar->venue }}</li>
                            <li>Sisa Kuota: {{ $seminar->max_participants - $seminar->current_participants }}</li>
                        </ul>
                        
                    </div>
                </div>        
            @endforeach

    </section>

    

</x-guest.layout>