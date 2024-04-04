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

        <main class="w-[82%] ml-[19%] flex flex-col">
            <h1 class=" text-2xl text-black font-bold capitalize pt-10 ">
                <span class="underline">les demandes de l'entreprise:</span> {{$client->company_name}}</h1>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-2xl font-bold mb-4">Solutions Sage:</h1>
                    @foreach($requests as $request)
                        <div class="mb-6 border border-gray-300 rounded-lg p-4">
                            <p class="font-semibold text-lg mb-2">Nom de l'entreprise: {{$client->user_name}}</p>
                            <p class="text-gray-700 mb-2">Les solutions sont:</p>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr class="">
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Service</th>
                                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Nombre des utilisateurs</th>
                                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Deuxième valeur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach(json_decode($request->sage, true) as $service => $values)
                                            <tr>
                                                <td class="px-4 py-2  whitespace-nowrap text-sm font-medium text-gray-900">{{ $service }}</td>
                                                <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">{{ $values[0] }}</td>
                                                <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">{{ $values[1] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-2xl font-bold mb-4">Solutions infrastructure:</h1>
                    @foreach($requests as $request)
                        <div class="mb-6 border border-gray-300 rounded-lg p-4">
                            <p class="font-semibold text-lg mb-2">Nom de l'entreprise: {{$client->user_name}}</p>
                            <p class="text-gray-700 mb-2">Les solutions sont:</p>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr class="">
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Service</th>
                                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Nombre des utilisateurs</th>
                                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Deuxième valeur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach(json_decode($request->infrastructure, true) as $service => $values)
                                            <tr>
                                                <td class="px-4 py-2  whitespace-nowrap text-sm font-medium text-gray-900">{{ $service }}</td>
                                                <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">{{ $values[0] }}</td>
                                                <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">{{ $values[1] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
                

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-2xl font-bold mb-4">Solutions microsoft:</h1>
                    @foreach($requests as $request)
                        <div class="mb-6 border border-gray-300 rounded-lg p-4">
                            <p class="font-semibold text-lg mb-2">Nom de l'entreprise: {{$client->user_name}}</p>
                            <p class="text-gray-700 mb-2">Les solutions sont:</p>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr class="">
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Service</th>
                                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Nombre des utilisateurs</th>
                                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Deuxième valeur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach(json_decode($request->microsoft, true) as $service => $values)
                                            <tr>
                                                <td class="px-4 py-2  whitespace-nowrap text-sm font-medium text-gray-900">{{ $service }}</td>
                                                <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">{{ $values[0] }}</td>
                                                <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">{{ $values[1] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-2xl font-bold mb-4">Solutions material:</h1>
                    @foreach($requests as $request)
                        <div class="mb-6 border border-gray-300 rounded-lg p-4">
                            <p class="font-semibold text-lg mb-2">Nom de l'entreprise: {{$client->user_name}}</p>
                            <p class="text-gray-700 mb-2">Les solutions sont:</p>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr class="">
                                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">Service</th>
                                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Nombre des utilisateurs</th>
                                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">Deuxième valeur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach(json_decode($request->material, true) as $service => $values)
                                            <tr>
                                                <td class="px-4 py-2  whitespace-nowrap text-sm font-medium text-gray-900">{{ $service }}</td>
                                                <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">{{ $values[0] }}</td>
                                                <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">{{ $values[1] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
        </main>
    </section>

</body>

</html>
