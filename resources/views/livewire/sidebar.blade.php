@props(['active'])

<div class=" w-[24rem] border-r-[1px] bg-white border-black flex flex-col justify-between text-start h-full" >
    <section class="px-12">
                <section class="flex flex-col gap-4">

                    <button class="border-b-[1px] border-[#6A9AB0] py-4 w-[12rem] text-2xl font-normal hover:px-2 transition-all text-start">Seminar</button>
                    <button class="border-b-[1px] border-[#6A9AB0] py-4 w-[12rem] text-2xl font-normal hover:px-2 transition-all text-start">Workshop</button>

                    @if (Route::has('login'))
                            
                            @auth
                                <a
                                    href="{{ route('admin') }}"
                                    class="border-b-[1px] border-[#6A9AB0] pb-8 w-[12rem] text-lg font-normal my-4 hover:px-2 transition-all">
                                    Admin
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="border-b-[1px] border-[#6A9AB0] pb-8 w-[12rem] text-lg font-normal my-4 hover:px-2 transition-all">
                                    Log in
                                </a>

                        
                            @endauth
                    
                    @endif

                </section>

            </section>
            

            <section class="flex flex-col gap-2 px-8">
                <div class="bg-[#6A9AB0] w-[16rem] h-[1px] self-center"></div>
                <h3 class="text-2xl font-normal my-2">From Kelompok 5</h3>

                <ul class="px-2 pb-2">
                    <li class="text-sm">Zamzam Muazam</li>
                    <li class="text-sm">Muhammad Gilang Alfarezel Putra Natsir Rasad</li>
                    <li class="text-sm">Adli Imam Suryadin</li>
                </ul>
             
                <div class="bg-[#6A9AB0] w-[16rem] h-[1px] mb-2 self-center"></div>
                
               
                <a href=""><h3 class="text-lg font-normal text-center">Web Framework, Sistem Informasi</h3></a>

                <div class="flex justify-center w-full py-4 gap-4">

                    <img class="w-16" src="{{ asset('assets/img/inforsa.svg') }}" alt="">
                    <img class="w-16" src="{{ asset('assets/img/unmul.svg') }}" alt="">
                </div>

            </section>
</div>