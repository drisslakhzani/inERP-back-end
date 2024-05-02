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
            <div class="h-12 flex justify-evenly items-center active">
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
            <div class="h-12 flex justify-evenly items-center ">
                <i class="fa-solid fa-file-circle-plus"></i>
                <a href="/posts/create" class="hover:underline w-6/12">
                    Ajouter un blog
                </a>
            </div>
        </nav>
        <form class="h-12 flex justify-evenly items-center  " action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class=" flex  ml-[2%] pt-3 pb-3 px-5 text-[14px] bg-black leading-4 text-white w-fit self-center uppercase font-[600] rounded-full -ml-10 mr-3 duration-200 hover:text-black hover:bg-white duration-150 cursor-pointer">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p class="hover:underline px-2 " >Déconnexion</p>
            </button>
        </form>
    </aside>

    <main class="w-[82%] ml-[19%] flex flex-col pr-8 pl-2 pt-8">
        <div>
            <h1 class="text-xl text-[#498D13] font-bold  capitalize pb-6">
                Les nouvelles commandes
            </h1>
            @if (count($clientRequests) > 0)
                <div class="flex flex-col">
                    <table id="data-table" class="border border-gray-300 shadow-md w-full mx-auto">
                        <thead>
                        <tr class="bg-gray-200 uppercase">
                            <th class="py-2 border border-gray-400">
                                Nom de l'entreprise
                            </th>
                            <th class="py-2 border border-gray-400">
                                Nom de l'utilisateur
                            </th>
                            <th class="py-2 border border-gray-400">
                                La date de la demande
                            </th>
                            <th class="py-2 border border-gray-400">
                                Statut
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clientRequests as $clientId => $requests)
                            @foreach ($requests as $clientRequest)
                                @if (!$clientRequest->status)
                                    <tr  x-data="{ clientId: {{ $clientRequest->client->id }} }"
                                        x-on:click="window.location.href = '/client/' + clientId"
                                        class="cursor-pointer hover:bg-[#498D13] hover:text-white duration-100 odd:bg-white even:bg-slate-100">
                                        <td class="border text-center pl-2 py-2">
                                            {{ $clientRequest->client->companyName }}
                                        </td>
                                        <td class="border text-center pl-2 py-2">
                                            {{ $clientRequest->client->firstName }}
                                        </td>
                                        <td class="border text-center pl-2 py-2">
                                            {{ $clientRequest->client->updated_at->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="border pl-2 py-2 flex items-center gap-2">
                                            <span>
                                                {{ $clientRequest->status == 1 ? 'Terminé' : 'En attente' }}
                                            </span>
                                            <span class="relative flex h-2 w-2 ">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#498D13] opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#498D13]"></span>
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="flex justify-center items-center">Il n'y a pas de nouveaux clients</p>
            @endif
        </div>


        <div>
            <h1 class="text-xl text-[#498D13] font-bold  capitalize py-6">
                Toutes les commandes
            </h1>
            @if (count($clientRequests) > 0)
                <div class="flex flex-col">
                    <table id="data-table" class="border border-gray-300 shadow-md w-full mx-auto">
                        <thead>
                        <tr class="bg-gray-200 uppercase">
                            <th class="py-2 border border-gray-400">
                                Nom de l'entreprise
                            </th>
                            <th class="py-2 border border-gray-400">
                                Nom de l'utilisateur
                            </th>
                            <th class="py-2 border border-gray-400">
                                La date de la demande
                            </th>
                            <th class="py-2 border border-gray-400">
                                Statut
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clientRequests as $clientId => $requests)
                            @foreach ($requests as $clientRequest)
                                @if ($clientRequest->status)
                                    <tr x-data="{ clientId: {{ $clientRequest->client->id }} }"
                                        x-on:click="window.location.href = '/client/' + clientId"
                                        class="cursor-pointer hover:bg-[#498D13] hover:text-white duration-100 odd:bg-white even:bg-slate-100">
                                        <td class="border pl-2 py-2 text-center">
                                            {{ $clientRequest->client->companyName }}
                                        </td>
                                        <td class="border text-center pl-2 py-2">
                                            {{ $clientRequest->client->firstName }}
                                        </td>
                                        <td class="border text-center pl-2 py-2">
                                            {{ $clientRequest->client->updated_at->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="border text-center pl-2 py-2 flex items-center gap-2">
                                            <span>
                                                {{ $clientRequest->status == 1 ? 'Terminé' : 'En attente' }}
                                            </span>
                                            <span class="relative flex h-2 w-2">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#498D13] opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#498D13]"></span>
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="flex justify-center items-center">Il n'y a pas de nouveaux clients</p>
            @endif
        </div>
    </main>
</section>

</body>

</html>
