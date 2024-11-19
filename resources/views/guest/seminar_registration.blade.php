<x-guest.layout>

    <article class="h-full w-full m-auto mb-12 flex justify-center items-center">

        <section class="max-w-3xl ">
            <div class="w-[96rem] rounded-lg shadow-md md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Registrasi sebagai peserta
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="/seminar/{{ $seminar->id }}/registration" method="post">
                        @csrf
                        <div>
                            <label for="seminar" class="block mb-2 text-sm font-medium text-gray-900">Acara Seminar</label>
                            <input disabled type="seminar" name="seminar" id="seminar" class="bg-gray-50 hover:bg-gray-100 border border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder={{ $seminar->name }} required="">
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                            <input type="string" name="name" id="name" class="bg-gray-50 hover:bg-gray-100 border border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Daerah Asal</label>
                            <input type="string" name="location" id="location" class="bg-gray-50 hover:bg-gray-100 border border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="edu_level" class="block mb-2 text-sm font-medium text-gray-900">Tingkat Pendidikan</label>
                            <input type="string" name="edu_level" id="edu_level" class="bg-gray-50 hover:bg-gray-100 border border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 hover:bg-gray-100 border border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900">Nomor Handphone</label>
                            <input type="number" name="phone_number" id="phone_number"  class="bg-gray-50 hover:bg-gray-100 border border-gray-300 text-gray-900 focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            
                        </div>
                        
        
                        <button type="submit" class="w-full text-white bg-[#7469B6] hover:bg-[#5f549e] transition-all focus:outline-none font-medium shadow-md text-sm px-5 py-2.5 text-center">Sign in</button>
        
                        <p class="text-sm font-light text-gray-500 text-center">
                            Kelompok 5 &copy; 2024 | Sistem Informasi, Universitas Mulawarman
                        </p>
                    </form>
                </div>
            </div>
        </section>
        
    </article>

   
    
</x-guest.layout>
