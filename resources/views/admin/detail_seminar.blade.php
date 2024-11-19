<x-admin.layout>
 
    {{-- Headline --}}
    <header>

        {{-- Hero image --}}
        <section class="shadow-md">
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
                <p class="font-light">{{ $seminar->description }}</p>
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
            
            

                <a
                    class="min-w-full p-4 bg-[#3A6D8C] text-white text-center font-medium tracking-widest uppercase shadow-lg hover:bg-[#326280] transition-all" 
                    href="{{ route('update-seminar-form', $seminar->id) }}"> edit acara 
                </a>

            
        
            

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
            <h2 class="text-3xl font-[350]">Lokasi Acara</h2>
            <p class="font-light">{{$seminar->venue}}</p>
            
        </aside>   

    </article> 

    

    {{-- Table --}}
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12 mb-12">
        <div class="bg-white dark:bg-white relative overflow-hidden shadow-md border-[1px]">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 ">

                <h3 class="w-full text-[#AD88C6] text-3xl font-semibold ml-4 ">Daftar Peserta</h3>

                <form class="w-full flex items-center ">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="search" id="search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-white dark:focus:outline-none dark:focus:ring-0 dark:placeholder-gray-400 dark:text-black dark:focus:border-primary-500 hover:bg-slate-50 focus:outline-none transition-all" placeholder="Cari nama peserta" autocomplete="off">
                    </div>
                </form>
           
            </div>
            <div class="overflow-x-auto "></div>
            <div class="border-b-[1px] border-gray-300 w-11/12 m-auto pb-2 mb-4"></div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <thead class="text-xs text-[#E1AFD1] uppercase bg-gray-50 dark:bg-white dark:text-[#AD88C6]">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama</th>
                            <th scope="col" class="px-4 py-3">Asal</th>
                            <th scope="col" class="px-4 py-3">Tingkat Pendidikan</th>
                            <th scope="col" class="px-4 py-3">Email</th>
                            <th scope="col" class="px-4 py-3">No. HP</th>
                            <th scope="col" class="px-4 py-3 text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($participants as $participant)

                            <tr class="">
                                <td scope="row" class="px-4 py-3 text-gray-900 whitespace-nowrap dark:text-black">{{$participant->name}}</td>
                                <td class="px-4 py-3 text-gray-700">{{$participant->location}}</td>
                                <td class="px-4 py-3 text-gray-700">{{$participant->educational_level}}</td>
                                <td class="px-4 py-3 text-gray-700">{{$participant->email}}</td>
                                <td class="px-4 py-3 text-gray-700">{{$participant->phone_number}}</td>
                                <td class="px-4 py-3 text-gray-700 flex items-center justify-center">
                                    {{-- <a href="#" class="block py-2 px-4 w-20 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white transition-all">Edit</a> --}}
                                    
                                    
                                    <form  action="{{ $seminar->id }}/delete-participant/{{ $participant->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white transition-all">Delete registration</button>
                                    </form>

                                    
                                </td>
                                
                            </tr>

            
                        
                    </tbody>

                    @empty

                            
                            <table class="px-4 py-3 text-gray-700 my-1 w-full">
                                <tbody>
                                    <tr>
                                        <td><div class="border-[1px] border-gray-300 w-full px-20"></div></td>
                                        <td><p class="px-4 py-3 text-center text-lg font-semibold text-gray-500">Belum ada pendaftar aowkokowkkw</p></td>
                                        <td><div class="border-[1px] border-gray-300 w-full px-20"></div></td>
                                    </tr>
                                </tbody>
                                
                                
                            </table>
                        
                        
                          
                        @endforelse
                </table>
            </div>

            
        </div>
    </div>
    
</x-admin.layout>
