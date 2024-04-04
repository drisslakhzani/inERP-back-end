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
                    <div class="h-12 flex items-center active">
                        <a href="{{route('clients.all')}}" class="pl-5 hover:underline">
                            Commande
                        </a>
                    </div>

                    <div class="h-12 flex items-center">
                        <a href="#" class="pl-5 hover:underline">
                            Ajouter une Image
                        </a>
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

            <main class="w-[82%] ml-[19%] flex flex-col pb-[5%]">
                <div>
                    <h1 class=" text-2xl text-[#498D13] font-bold capitalize py-6 underline">les nouvelles commandes:</h1>
                    @if ($new_clients->isEmpty())
                        <p class="flex justify-center items-center">There are no users</p>
                    @else
                        <div class="flex flex-col">
                            <table id="data-table" class="border border-gray-300 shadow-md rounded-lg">
                                <thead>
                                    <tr class="bg-gray-200 text-lg font-bold uppercase">
                                        <th class="px-4 py-2 border border-gray-400">Nom de l'entreprise</th>
                                        <th class="px-4 py-2 border border-gray-400">Nom de l'utilisateur</th>
                                        <th class="px-4 py-2 border border-gray-400">La date de la demande</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($new_clients as $index => $client )
                                        <tr class="cursor-pointer hover:bg-[#498D13] hover:text-white duration-150" 
                                            x-data="{ odd: {{ $index % 2 === 1 ? 'true' : 'false' }} }" 
                                            :class="{ 'bg-gray-100': odd }">
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('clients.individual', ['client' => $client->id]) }}">
                                                    {{ $client->company_name }}
                                                </a>
                                            </td>
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('clients.individual', ['client' => $client->id]) }}">
                                                    {{ $client->user_name }}
                                                </a>
                                            </td>
                                            <td class="border px-4 py-2 text-center">
                                                <a href="{{ route('clients.individual', ['client' => $client->id]) }}">
                                                    {{ $client->created_at }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <hr class="my-8 border-b border-gray-300">
               
                
            <div >
                <h1 class="text-2xl text-[#498D13] font-bold capitalize pb-6 underline">toutes les commandes:</h1>
                @if ($all_clients->isEmpty())
                    <p class="flex justify-center items-center">There are no users</p>
                @else
                    <div class="flex flex-col">
                        <table id="data-table" class="border border-gray-300 shadow-md rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 text-lg font-bold uppercase">
                                    <th class="px-4 py-2 border border-gray-400">Nom de l'entreprise</th>
                                    <th class="px-4 py-2 border border-gray-400">Nom de l'utilisateur</th>
                                    <th class="px-4 py-2 border border-gray-400">La date de la demande</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_clients as $index => $client)
                                    <tr class="cursor-pointer hover:bg-[#498D13] hover:text-white duration-150" 
                                        x-data="{ odd: {{ $index % 2 === 1 ? 'true' : 'false' }} }" 
                                        :class="{ 'bg-gray-100': odd }">
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('clients.individual', ['client' => $client->id]) }}">
                                                {{ $client->company_name }}
                                            </a>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('clients.individual', ['client' => $client->id]) }}">
                                                {{ $client->user_name }}
                                            </a>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('clients.individual', ['client' => $client->id]) }}">
                                                {{ $client->created_at }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                    
            </div>
            </main>
        </section>

    </body>

    </html>
