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



    {{-- Styles --}}
    @vite('resources/css/app.css')
    @vite('resources/css/admin/index.css')
    @vite('../../js/admin/dashboard.js')

    <title>Dashboard</title>
</head>

<body>

    <section class="w-full h-screen flex">
        <aside class="w-[18%] h-full fixed bg-[#498D13] shadow-md text-white py-5">

            <nav class="ml-3 flex flex-col gap-2 justify-center  text-sm lg:text-base">

                <img class="w-[70%] self-center pb-5" height="400" src="{{ asset('assets/inerp_logo.png') }}"
                    alt="inerp_logo">
                <div class="h-12 flex justify-evenly items-center">
                    <i class="fa-solid fa-house"></i>
                    <a href="/client" class="hover:underline w-6/12">
                        Dashboard
                    </a>
                </div>

                <div class="h-12 flex justify-evenly items-center active">
                    <i class="fa-solid fa-wrench"></i>
                    <a href="" class="hover:underline w-6/12">
                        Modifier
                    </a>
                </div>

            </nav>
        </aside>

        <main class="w-[82%] ml-[19%] flex flex-col px-6 pt-8">
            <h1 class="text-2xl pb-5 ">
                Les demandes de l'entreprise
                {{-- {{ $client->company_name }} --}}
                <span class="font-semibold">Bitcode</span>
            </h1>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-10">
                <h1 class="text-xl text-[#498D13] font-bold  capitalize pb-6">
                    Solutions Sage
                </h1>
                {{-- @foreach ($requests as $request) --}}
                <div class="border border-gray-300 rounded-lg p-4 ">
                    <p class="text-lg mb-4">
                        Nom de l'entreprise:
                        <span class="font-semibold">{{-- $client->user_name --}} Oussama Roui</span>
                    </p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr class="">
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">
                                        Service</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">
                                        Nombre des utilisateurs</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">
                                        Deuxième valeur</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                {{-- @foreach (json_decode($request->sage, true) as $service => $values) --}}
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{-- $service --}}111
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">
                                        {{-- $values[0] --}}222
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">
                                        {{-- $values[1] --}}333
                                    </td>
                                </tr>
                                {{-- {{-- @endforeach --}}
                            </tbody>
                        </table>
                        <form action="{{-- route('toggle.flags', ['clientId' => $client->id, 'requestId' => $request->id]) --}}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="toggle_flag" value="sage">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300 ease-in-out">
                                Toggle Sage
                            </button>
                        </form>


                    </div>
                </div>
                {{-- {{-- @endforeach --}}
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-10">
                <h1 class="text-xl text-[#498D13] font-bold  capitalize pb-6">
                    Solutions Infrastructure
                </h1>
                {{-- @foreach ($requests as $request) --}}
                <div class=" border border-gray-300 rounded-lg p-4  ">
                    <p class="text-lg mb-4">
                        Nom de l'entreprise:
                        <span class="font-semibold">{{-- $client->user_name --}} Bitcode</span>
                    </p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr class="">
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">
                                        Service</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">
                                        Nombre des utilisateurs</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">
                                        Deuxième valeur</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                {{-- @foreach (json_decode($request->infrastructure, true) as $service => $values) --}}
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{-- $service --}}111
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">
                                        {{-- $values[0] --}}222
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">
                                        {{-- $values[1] --}}333
                                    </td>
                                </tr>
                                {{-- {{-- @endforeach --}}
                            </tbody>
                        </table>
                        <form action="{{-- route('toggle.flags', ['clientId' => $client->id, 'requestId' => $request->id]) --}}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="toggle_flag" value="infrastructure">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300 ease-in-out">
                                Toggle Infrastructure
                            </button>
                        </form>


                    </div>
                </div>
                {{-- {{-- @endforeach --}}
            </div>


            <div class="bg-white rounded-lg shadow-lg p-6 mb-10">
                <h1 class="text-xl text-[#498D13] font-bold  capitalize pb-6">
                    Solutions Microsoft
                </h1>
                {{-- @foreach ($requests as $request) --}}
                <div class=" border border-gray-300 rounded-lg p-4  ">
                    <p class="text-lg mb-4">
                        Nom de l'entreprise:
                        <span class="font-semibold">{{-- $client->user_name --}} Microsoft Company</span>
                    </p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr class="">
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">
                                        Service</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">
                                        Nombre des utilisateurs</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">
                                        Deuxième valeur</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                {{-- @foreach (json_decode($request->microsoft, true) as $service => $values) --}}
                                <tr>
                                    <td class="px-4 py-2  whitespace-nowrap text-sm font-medium text-gray-900">
                                        111
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">
                                        222
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">
                                        333
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                        <form action="{{-- route('toggle.flags', ['clientId' => $client->id, 'requestId' => $request->id]) --}}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="toggle_flag" value="microsoft">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300 ease-in-out">
                                Toggle Microsoft
                            </button>
                        </form>
                    </div>
                </div>
                {{-- {{-- @endforeach --}}
            </div>


            <div class="bg-white rounded-lg shadow-lg p-6 mb-10">
                <h1 class="text-xl text-[#498D13] font-bold  capitalize pb-6">
                    Solutions Material
                </h1>
                {{-- @foreach ($requests as $request) --}}
                <div class=" border border-gray-300 rounded-lg p-4  ">
                    <p class="text-lg mb-4">
                        Nom de l'entreprise:
                        <span class="font-semibold">Vitcode</span>
                    </p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr class="">
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase">
                                        Service</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">
                                        Nombre des utilisateurs</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 uppercase">
                                        Deuxième valeur</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                {{-- @foreach (json_decode($request->material, true) as $service => $values) --}}
                                <tr>
                                    <td class="px-4 py-2  whitespace-nowrap text-sm font-medium text-gray-900">
                                        111
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">
                                        222
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-600">
                                        333
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                        <form action="{{-- route('toggle.flags', ['clientId' => $client->id, 'requestId' => $request->id]) --}}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="toggle_flag" value="material">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300 ease-in-out">
                                Toggle Material
                            </button>
                        </form>
                    </div>
                </div>
                {{-- {{-- @endforeach --}}
            </div>

        </main>
    </section>

</body>

</html>
