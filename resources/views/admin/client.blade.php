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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script defer src="{{ asset('js/admin/dashboard.js') }}"></script>
    <script>
        function toggleStatus(requestId, solutionIndex) {
            axios.put(`/client-request/${requestId}/toggle-status`, { solutionIndex: solutionIndex })
                .then(response => {
                    // Reload the page or update UI as needed
                    console.log(response.data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function filterSolutions() {
            var selectedType = document.getElementById('solutionTypeFilter').value;
            var rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                var request = JSON.parse(row.dataset.request);
                var solutions = request.selectedSolutions;

                // Check if any of the solutions have the selectedType
                if (solutions.some(solution => solution.solutionType.toLowerCase() === selectedType)) {
                    row.style.display = ''; // Display the row if it matches the selectedType
                } else {
                    row.style.display = 'none'; // Hide the row if it doesn't match the selectedType
                }
            });
        }

        function isSolutionTypeMatch(solutions, selectedType) {
            for (var i = 0; i < solutions.length; i++) {
                if (solutions[i].solutionType.toLowerCase() === selectedType) {
                    return true;
                }
            }
            return false;
        }

        function deleteSolution(requestId, solutionIndex) {
            axios.delete(`/client-request/${requestId}/delete-solution/${solutionIndex}`)
                .then(response => {
                    // Reload the page or update UI as needed
                    console.log(response.data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error(error);
                });
        }

        // Define selectedSolutionType variable for binding
        var selectedSolutionType = '';
    </script>



    {{-- Styles --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">



    <title>Tableau de bord</title>
</head>
<body>
<section class="w-full h-screen flex">
    <aside class="w-[18%] h-full flex flex-col justify-between fixed bg-[#498D13] shadow-md text-white py-5">

        <nav class="ml-3 flex flex-col gap-2 justify-center  text-sm lg:text-base">

            <img class="w-[70%] self-center pb-5" height="400" src="{{ asset('assets/inerp_logo.png') }}"
                 alt="inerp_logo">
            <div class="h-12 flex justify-evenly items-center active ">
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

    <main class="w-[80%] ml-[20%] px-6 py-8" x-data="{ isOpen: false }">
        <!-- Détails du client -->
        <div class="bg-white shadow-md rounded p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Détails du client</h1>
            </div>

            <div  class="flex justify-evenly ">
                <div class=" flex text-2xl p-4 rounded">
                    <p class="font-semibold">Nom du client :</p>
                    <p class=" px-3 font-bold">{{ $client->firstName }}</p>
                </div>
                <div class=" flex text-2xl p-4 rounded">
                    <p class="font-semibold">Nom de l'entreprise :</p>
                    <p class=" px-3 font-bold">{{ $client->companyName }}</p>
                </div>
                <div class="bg-white p-4 rounded">
                    <a href="mailto:{{ $client->email }}"
                       target="_blank" class=" flex items-center  ml-[2%] pt-3 pb-3 px-5 text-[14px] bg-[#e43b29] leading-4 text-white w-fit self-center uppercase font-[600] rounded-full -ml-10 mr-3 duration-200 hover:text-white hover:bg-[#e96253] duration-150 cursor-pointer"><i class="fa-solid fa-envelope-open-text px-3 scale-150"></i>Email</a>
                </div>
                <div class=" p-4 rounded">
                    <a :href="'https://wa.me/{{ $client->phoneNumber }}'" target="_blank" class=" flex items-center  ml-[2%] pt-3 pb-3 px-5 text-[14px] bg-[#498D13] leading-4 text-white w-fit self-center uppercase font-[600] rounded-full -ml-10 mr-3 duration-200 hover:text-white hover:bg-black duration-150 cursor-pointer"><i class="fa-brands  fa-whatsapp px-3 scale-150"></i>Whatsapp</a>
                </div>
            </div>
        </div>

        <!-- Demandes du client -->
        <div class="mt-10">
            <!-- Demandes du client -->
            <div class="mt-10">
                <h1 class="text-xl text-[#498D13] font-bold capitalize pb-6">Solutions sélectionnées</h1>
                <!-- Afficher les solutions sélectionnées -->
                <div class="flex flex-col">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Solution</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Type de solution</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Numéro</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase w-[30%] tracking-wider">Options supplémentaires</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($requests as $request)
                            @foreach ($request->selectedSolutions as $index => $selectedSolution)
                                @if ($selectedSolution['solutionCategory'] === 'sage')
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $selectedSolution['solution'] }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $selectedSolution['solutionType'] }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $selectedSolution['number'] }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <ul class="disc">
                                                @foreach ($selectedSolution['additionalOption'] ?? [] as $option)
                                                    <li class="py-2">+{{ $option }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $selectedSolution['status'] ? 'OK' : 'En attente' }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <button @click="toggleStatus({{ $request->id }}, {{ $index }})" class="bg-[#498D13] text-white px-4 py-2 rounded-full mt-2">
                                                Changer de statut
                                            </button>
                                            <button @click="deleteSolution({{ $request->id }}, {{ $index }})" class="bg-red-500 text-white px-4 py-2 rounded-full mt-2 ml-2">
                                                Supprimer
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Microsoft Solutions -->
                    <div class="mt-10" x-data="{ isOpen: false }">
                        @if (!empty($selectedSolution['solution']) && $selectedSolution['solutionCategory'] === 'microsoft')
                            <h1 @click="isOpen = !isOpen" class="text-xl text-[#498D13] font-bold capitalize pb-6 cursor-pointer">
                                Microsoft Solutions <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </h1>
                            <!-- Display Microsoft Solutions -->
                            <div x-show="isOpen" class="flex flex-col">
                                @foreach ($requests as $request)
                                    @foreach ($request->selectedSolutions as $index => $selectedSolution)
                                        @if (!empty($selectedSolution['solution']) && $selectedSolution['solutionCategory'] === 'microsoft')
                                            <div class="flex flex-col">
                                                <p class="text-black font-bold">besion du client:{{ $selectedSolution['solution'] }}</p>
                                                <span class="flex ">
                                                    <button @click="toggleStatus({{ $request->id }}, {{ $index }})" class="bg-[#498D13] text-white px-4 py-2  mt-2 w-fit rounded-full ">
                                                    Toggle Status
                                                    </button>
                                                    <button @click="deleteSolution({{ $request->id }}, {{ $index }})" class="bg-red-500 text-white px-4 py-2  mt-2 ml-2 w-fit rounded-full ">
                                                    Supprimer
                                                    </button>

                                                </span>

                                            </div>

                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Infrastructure Solutions -->
                    <div class="mt-10" x-data="{ isOpen: false }">
                        @if (!empty($selectedSolution['solution']) && $selectedSolution['solutionCategory'] === 'infrastructure')
                            <h1 @click="isOpen = !isOpen" class="text-xl text-[#498D13] font-bold capitalize pb-6 cursor-pointer">
                                Infrastructure Solutions <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </h1>
                            <!-- Display Infrastructure Solutions -->
                            <div x-show="isOpen" class="flex flex-col">
                                @foreach ($requests as $request)
                                    @foreach ($request->selectedSolutions as $index => $selectedSolution)
                                        @if (!empty($selectedSolution['solution']) && $selectedSolution['solutionCategory'] === 'infrastructure')
                                            <div class="flex flex-col">
                                                <p class="text-black font-bold">besion du client:{{ $selectedSolution['solution'] }}</p>
                                                <span class="flex ">
                                                    <button @click="toggleStatus({{ $request->id }}, {{ $index }})" class="bg-[#498D13] text-white px-4 py-2  mt-2 w-fit rounded-full">
                                                    Toggle Status
                                                    </button>
                                                    <button @click="deleteSolution({{ $request->id }}, {{ $index }})" class="bg-red-500 text-white px-4 py-2  mt-2 ml-2 w-fit rounded-full">
                                                    Supprimer
                                                    </button>

                                                </span>

                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Material Solutions -->
                    <div class="mt-10" x-data="{ isOpen: false }">
                        @if (!empty($selectedSolution['solution']) && $selectedSolution['solutionCategory'] === 'material')
                            <h1 @click="isOpen = !isOpen" class="text-xl text-[#498D13] font-bold capitalize pb-6 cursor-pointer">
                                Material Solutions <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </h1>
                            <!-- Display Material Solutions -->
                            <div x-show="isOpen" class="flex flex-col">
                                @foreach ($requests as $request)
                                    @foreach ($request->selectedSolutions as $index => $selectedSolution)
                                        @if (!empty($selectedSolution['solution']) && $selectedSolution['solutionCategory'] === 'material')
                                            <div class="flex flex-col">
                                                <p class="text-black font-bold">besion du client:{{ $selectedSolution['solution'] }}</p>
                                                <span class="flex ">
                                                    <button @click="toggleStatus({{ $request->id }}, {{ $index }})" class="bg-[#498D13] text-white px-4 py-2  mt-2 w-fit rounded-full">
                                                    Toggle Status
                                                    </button>
                                                    <button @click="deleteSolution({{ $request->id }}, {{ $index }})" class="bg-red-500 text-white px-4 py-2  mt-2 ml-2 w-fit rounded-full">
                                                    Supprimer
                                                    </button>

                                                </span>

                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </main>
</section>
</body>
</html>
