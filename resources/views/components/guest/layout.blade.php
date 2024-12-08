<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100 ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manajemen Acara</title> 
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

</head>
<body class="flex flex-col h-full m-0 ">
 
    <header >
            <x-guest.header></x-header>    
    </header>

    <section class="flex justify-between flex-auto bg-white ">
        <!-- Sidebar -->
        <aside>
            <x-guest.sidebar></x-sidebar>
        </aside>

        <main class="w-full" >    
            @livewire('guest-dashboard')
        </main>
    </section>

    <footer >
        <x-guest.footer></x-footer>
    </footer>
        
</body>
</html>