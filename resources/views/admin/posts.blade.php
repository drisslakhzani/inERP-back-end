<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Styles --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/admin/index.css')
    @vite('../../js/admin/dashboard.js')

    <title>Tableau de bord</title>
</head>

<body>

<section class="w-full h-screen flex">
    <aside class="w-[18%] h-full flex flex-col justify-between fixed bg-[#498D13] shadow-md text-white py-5">

        <nav class="ml-3 flex flex-col gap-2 justify-center  text-sm lg:text-base">

            <img class="w-[70%] self-center pb-5" height="400" src="{{ asset('assets/inerp_logo.png') }}"
                 alt="inerp_logo">
            <div class="h-12 flex justify-evenly items-center ">
                <i class="fa-solid fa-house"></i>
                <a href="/client" class="hover:underline w-6/12">
                    Tableau de bord
                </a>
            </div>

            <div class="h-12 flex justify-evenly items-center  ">
                <i class="fa-solid fa-wrench"></i>
                <a href="/admin/edit" class="hover:underline w-6/12">
                    Info d'administration
                </a>
            </div>
            <div class="h-12 flex justify-evenly items-center active  ">
                <i class="fa-solid fa-file-circle-plus"></i>
                <a href="/posts/create" class="hover:underline w-6/12">
                    Ajouter un blog
                </a>
            </div>
        </nav>
        <form class="h-12 flex justify-evenly items-center  " action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex ml-[2%] pt-3 pb-3 px-5 text-[14px] bg-black leading-4 text-white w-fit self-center uppercase font-[600] rounded-full -ml-10 mr-3 duration-200 hover:text-black hover:bg-white duration-150 cursor-pointer">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p class="hover:underline px-2">Déconnexion</p>
            </button>
        </form>
    </aside>

    <main class="w-[72%] ml-[24%] flex flex-col pr-8 pl-2 pt-8">
        <h1 class="text-2xl font-bold mb-4">Ajouter un nouvel article</h1>
        <form action="{{ route('posts.store') }}" class="flex flex-col " method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Titre :</label>
                <input type="text" id="title" name="title" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description :</label>
                <textarea id="description" name="description" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
            <div class="mb-4">
                <label for="long_text" class="block text-gray-700 font-bold mb-2">Texte long :</label>
                <textarea id="long_text" name="long_text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image :</label>
                <input type="file" id="image" name="image" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <button type="submit" class="ml-[2%] pt-3 pb-3 px-5 text-[14px] bg-black leading-4 text-white w-fit self-center uppercase font-[600] rounded-full -ml-10 mr-3 duration-200 hover:text-white hover:bg-[#498D13] duration-150 cursor-pointer">Soumettre</button>
        </form>
    </main>
</section>

</body>

</html>
