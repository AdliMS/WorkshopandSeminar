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
<body class="flex flex-col h-full m-0 ">
 

    <header >
            <x-admin.header></x-header>    
    </header>


    <section class="flex justify-between flex-auto ">

        <!-- Sidebar -->
        <aside>
            <x-admin.sidebar></x-sidebar>
        </aside>

        <main class="w-full">    

          {{$slot}}

        </main>

    </section>


    <footer >
        <x-admin.footer></x-footer>
    </footer>
        
    
</body>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('updateProductButton').click();
  });
</script>
</html>