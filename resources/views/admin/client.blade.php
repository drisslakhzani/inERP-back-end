<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

                if (selectedType === '' || isSolutionTypeMatch(solutions, selectedType)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
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
    @vite('resources/css/app.css')
    @vite('resources/css/admin/index.css')
    @vite('../../js/admin/dashboard.js')

    <title>Dashboard</title>
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
        <!-- Client Details -->
        <div class="bg-white shadow-md rounded p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Client Details</h1>
                <button @click="isOpen = !isOpen" class="text-blue-500 focus:outline-none">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div x-show="isOpen" class="space-y-4">
                <div class="bg-gray-100 p-4 rounded">
                    <p class="font-semibold">Name:</p>
                    <p>{{ $client->firstName }}</p>
                </div>
                <div class="bg-white p-4 rounded">
                    <p class="font-semibold">Email:</p>
                    <p>{{ $client->email }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded">
                    <p class="font-semibold">Phone Number:</p>
                    <a :href="'https://wa.me/{{ $client->phoneNumber }}'" target="_blank" class="text-blue-500 hover:underline">{{ $client->phoneNumber }}</a>
                </div>
            </div>
        </div>

        <!-- Client Requests -->
        <div class="mt-10">
            <!-- Solution Type Filter -->
            <select class="" id="solutionTypeFilter" x-model="selectedSolutionType" @change="filterSolutions()">
                <option value="">All</option>
                <option value="sage">Sage</option>
                <option value="infrastructure">Infrastructure</option>
                <option value="material">Material</option>
                <option value="microsoft">Microsoft</option>
            </select>
            <!-- Client Requests -->
            <div class="mt-10">
                <h1 class="text-xl text-[#498D13] font-bold capitalize pb-6">Selected Solutions</h1>
                <!-- Display Selected Solutions -->
                <!-- Display Selected Solutions -->
                <div class="flex flex-col">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Solution</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Solution Type</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Number</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Additional Options</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($requests as $request)
                            @foreach ($request->selectedSolutions as $index => $selectedSolution)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $selectedSolution['solution'] }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $selectedSolution['solutionType'] }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $selectedSolution['number'] }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <ul class="disc">
                                            @foreach ($selectedSolution['additionalOption'] ?? [] as $option)
                                                <li>{{ $option }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $selectedSolution['status'] ? 'OK' : 'Pending' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <button @click="toggleStatus({{ $request->id }}, {{ $index }})" class="bg-[#498D13] text-white px-4 py-2 rounded mt-2">
                                            Toggle Status
                                        </button>
                                        <button @click="deleteSolution({{ $request->id }}, {{ $index }})" class="bg-red-500 text-white px-4 py-2 rounded mt-2 ml-2">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </main>

</section>
</body>
</html>
