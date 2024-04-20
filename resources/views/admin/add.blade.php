<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @vite('resources/css/app.css')
        @vite('resources/css/admin/index.css')
        @vite('../../js/admin/dashboard.js')

    <title>Dashboard</title>
</head>

<body>

    <section class="w-full h-screen flex">
        <aside class="w-[18%] h-full fixed bg-[#498D13] shadow-md text-white py-5">
            <h1 class="uppercase text-center text-2xl font-medium mb-8">dashboard</h1>

            <nav class="ml-3 flex flex-col gap-2 justify-center text-sm lg:text-base">
                <div class="h-12 flex justify-evenly items-center active">
                    <a href="{{route('clients.all')}}" class="pl-5 hover:underline">
                        Dashboard 
                    </a>
                    <i class="fa-solid fa-house"></i>
                </div>

                <div class="h-12 flex justify-evenly items-center">
                    <a href="#" class="pl-5 hover:underline">
                        Modifier 
                    </a>
                    <i class="fa-solid fa-wrench"></i>
                </div>

                <div class="h-12 flex items-center">
                    <a href="#" class="pl-5 hover:underline">Mes images</a>
                </div>

                <div class="h-12 flex items-center">
                    <a href="#" class="pl-5 hover:underline">
                        Les utilisateurs
                    </a>
                </div>
            </nav>
        </aside>

        <div>

            @foreach($admins as $admin)
                <div>
                    <span>{{ $admin->file_name }}</span>
                    @if ($admin->file_url)
                        <a href="{{ $admin->file_url }}">Download</a>
                    @else
                        <span>No file uploaded</span>
                    @endif
                </div>
            @endforeach

        </div>

        

        
    </section>

</body>

</html>
