<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100 ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manajemen Acara</title> 
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class=" h-full m-0 bg-white flex justify-center items-center flex-wrap">

    <div class=" h-full w-1/2 m-0 bg-white flex justify-center items-center flex-wrap gap-4 ">

        <a class="w-96 bg-white p-5 font-semibold text-center text-[#7469B6] text-2xl uppercase shadow-md hover:bg-gray-50 transition-all" href="{{ url('admin/seminars') }}">Lihat Seminar</a>
        <a class="w-96 bg-white p-5 font-semibold text-center text-[#7469B6] text-2xl uppercase shadow-md hover:bg-gray-50 transition-all" href="{{ url('/admin/seminar/tambah') }}">Tambah Seminar</a>
        <a class="w-96 bg-white p-5 font-semibold text-center text-[#7469B6] text-2xl uppercase shadow-md hover:bg-gray-50 transition-all" href="{{ url('admin/workshops') }}">Lihat Workshop</a>
        <a class="w-96 bg-white p-5 font-semibold text-center text-[#7469B6] text-2xl uppercase shadow-md hover:bg-gray-50 transition-all" href="{{ url('admin/workshop/tambah') }}">Tambah Workshop</a>

        <form class="w-96 bg-white p-5 font-semibold text-center text-[#7469B6] text-2xl uppercase shadow-md hover:bg-gray-50 transition-all" method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link  
            :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
            
        </form>

        
    </div>

        
</body>
</html>

