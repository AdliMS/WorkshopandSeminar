<x-guest.layout>

    
    
    {{-- Headline --}}
    <header>

        {{-- Hero image --}}
        <section>
            <img class="border-b-4 border-[#EAD8B1] overflow-" src="{{ asset('assets/img/hero.jpg') }}" alt="">
        </section>

        {{-- Headline Content --}}
        <section class="pb-20 border-b-[1px] border-gray-500 flex justify-between mt-6 h-fit w-3/4 m-auto mb-12">

            <section class="">
                <span class="text-sm text-gray-500 border-[1px] border-gray-500">Seminar</span>
                <h1 class="text-4xl ">{{$seminar->name}}</h1>
                <p class="mb-3 text-sm font-normal text-gray-500">Diselenggarakan oleh: Komunitas Pangkalan Besi</p>
            </section>
    
            <section class="text-center">
                <h4>Terbuka Hingga:</h4>
                <h2 class="font-bold mb-4">{{ Carbon\Carbon::parse($seminar->open_until)->format('j F, o')}}</h2>
    
                <h4>Sisa Kuota:</h4>
                <h2 class="font-bold mb-4">{{ $seminar->max_participants - $seminar->current_participants }}</h2>
            </section>
        </section>

    </header>
    
    {{-- Main Content --}}
    <article class="mt-6 h-fit w-3/4 m-auto mb-12 flex justify-between">

        {{-- Description --}}
        <section class="max-w-2xl flex flex-col gap-6">
            <section>
                <h2 class="text-3xl">Deskripsi</h2>
                <img class="my-2" src="{{ asset('assets/img/event.jpg') }}" alt="">
                <p class="font-light">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis facere quisquam harum veniam illo consectetur est. Sequi fuga iure natus dolorem ut, accusamus odit eaque labore eveniet temporibus iusto. Necessitatibus nam suscipit veniam perspiciatis dolorum ipsa rerum? Ipsum dolor ullam asperiores sint totam iure necessitatibus sit. Suscipit cum veniam incidunt ea eos eveniet, dolorem ducimus facilis molestias, sunt, sequi sint architecto quibusdam aut qui quas voluptatibus odio fugit fugiat laboriosam?</p>
            </section>

            <section>
                <h2 class="text-3xl mb-4">Peserta yang bisa mendaftar</h2>
                <ul class="list-disc px-8 font-light">
                    @forelse ($requirements as $requirement)
                        <li>{{$requirement->name}}</li>
                    @empty
                        <li>Tidak membutuhkan persyaratan</li>
                    @endforelse
                </ul>
            </section>   
        </section>

        {{-- Aside --}}
        <aside class="w-80 flex flex-col gap-12">

            <section class="flex flex-col gap-2">
                <h2 class="text-3xl font-[350]">Pendaftaran</h2>
                <a class="min-w-full p-4 bg-[#3A6D8C] text-white text-center font-medium tracking-widest uppercase shadow-lg hover:bg-[#326280] transition-all" 
                href='/seminar/{{ $seminar->id }}/registration'> daftar ke acara </a>
            </section>
            

            {{-- Jadwal Pelaksanaan --}}
            <section class="flex flex-col gap-2">
                <h2 class="text-3xl font-[350]">Jadwal Pelaksanaan</h2>
                <table class="font-light">
                    <tr>
                        <td>Mulai</td>
                        <td class="font-bold">: {{ Carbon\Carbon::parse($seminar->start_time)->format('j F o') }}</td>
                        <td >{{ Carbon\Carbon::parse($seminar->start_time)->format(' H:i') }}</td>
                    </tr>
                    <tr>
                        <td>Selesai</td>
                        <td class="font-bold">: {{ Carbon\Carbon::parse($seminar->end_time)->format('j F o') }}</td>
                        <td >{{ Carbon\Carbon::parse($seminar->end_time)->format(' H:i') }}</td>
                    </tr>
                </table>
            </section>

            {{-- Lokasi --}}
            <section class="flex flex-col gap-2">
                <h2 class="text-3xl font-[350]">Lokasi Acara</h2>
                <p class="font-light">{{$seminar->venue}}</p>
            </section>
        </aside>   


    </article>

    

</x-guest>