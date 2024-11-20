
<x-guest.layout>


    <section class="flex justify-center p-8 gap-8 flex-wrap bg-white w-full ">

        @foreach ($workshops as $workshop)
                <div class="max-w-2xl min-h-fit bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-all">

                    {{-- Link to individual event --}}
                    <a href="workshop/{{ $workshop->id }}">
                        <img class="rounded-t-lg" src="{{ asset('assets/img/event.jpg') }}" alt="" />
                    </a>

                    <div class="p-5">

                        {{-- Link to individual event --}}
                        <a href="workshop/{{ $workshop->id }}">
                            <h5 class="mb-1 text-3xl font-md tracking-tight text-[#3A6D8C] hover:underline">{{ $workshop->name }}</h5>
                        </a>

                        <p class="mb-3 text-sm font-normal text-gray-700">Diselenggarakan oleh: Komunitas Pangkalan Besi</p>
                        <p class="my-6 font-normal text-gray-700">{{ $workshop->description }}</p>

                        <ul class="text-sm mb-3 ml-8 font-normal text-gray-700">
                            <li>Mulai: {{ Carbon\Carbon::parse($workshop->start_time)->format('j F o') }}</li>
                            <li>Lokasi: {{ $workshop->venue }}</li>
                            <li>Sisa Kuota: {{ $workshop->max_participants - $workshop->current_participants }}</li>
                        </ul>
                        
                        {{-- <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#6A9AB0] rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a> --}}
                    </div>
                </div>        
            @endforeach

    </section>

    

</x-guest.layout>