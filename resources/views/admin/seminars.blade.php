
<x-admin.layout>


    <section class="flex justify-center items-center p-8 gap-8 flex-wrap bg-white w-full h-full">

        @foreach ($seminars as $seminar)
                <div class="max-w-2xl min-h-fit bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-all">
                    {{-- Link to individual event --}}
                    <a href="{{ route('admin-seminar', ['seminar' => $seminar]) }}">
                        <img class="rounded-t-lg" src="{{ asset('assets/img/event.jpg') }}" alt="" />
                    </a>

                    <div class="p-5">

                        {{-- Link to individual event --}}
                        <a href="{{route('admin-seminar', ['seminar' => $seminar]) }}">
                            <h5 class="mb-1 text-3xl font-md tracking-tight text-[#AD88C6] hover:underline">{{ $seminar->name }}</h5>
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

    

</x-admin.layout>