<html lang="fr">

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
    <script>
        function switchToEditMode() {
            document.getElementById('displayMode').style.display = 'none';
            document.getElementById('editMode').style.display = 'block';
        }

        function cancelEdit() {
            document.getElementById('displayMode').style.display = 'block';
            document.getElementById('editMode').style.display = 'none';
        }
        function showSuccessMessage() {
            var popup = document.getElementById("successPopup");
            popup.classList.toggle("show");
            setTimeout(function () {
                popup.classList.toggle("show");
            }, 2000);
        }
    </script>
    <style>
        .success-popup {
            visibility: hidden;
            position: fixed;
            left: 50%;
            bottom: 20px;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 5px;
            z-index: 1;
        }

        .success-popup.show {
            visibility: visible;
            animation: fadeIn 0.5s, fadeOut 0.5s 1.5s;
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeOut {
            from {opacity: 1;}
            to {opacity: 0;}
        }
    </style>

    @vite('resources/css/app.css')
    @vite('resources/css/admin/index.css')
    @vite('../../js/admin/dashboard.js')

    <title>Tableau de bord</title>
</head>

<body>

<section class="  h-screen flex">
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

            <div class="h-12 flex justify-evenly items-center  active ">
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

    <div id="adminDetails" class="ml-[30%] w-[60%]">
        <div id="successPopup" class="success-popup">Données de l'administrateur mises à jour avec succès</div>

        <!-- Display mode -->
        <div id="displayMode" class="shadow-lg flex flex-col mt-10 p-10">
            <h1 class="text-2xl font-bold uppercase underline  mb-4">Détails de l'administrateur</h1>
            <div class="space-y-2 pb-5 py-10 mb-5">
                <div class="flex justify-between">
                    <span class="font-bold">Nom :</span>
                    <span>{{ $admin->adminName }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold">Numéro de téléphone :</span>
                    <span>{{ $admin->phoneNumber }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold">Numéro WhatsApp :</span>
                    <span>{{ $admin->whatsappNumber }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold">Email :</span>
                    <span>{{ $admin->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold">Facebook :</span>
                    <span>{{ $admin->facebook }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold">Instagram :</span>
                    <span>{{ $admin->instagram }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold">LinkedIn :</span>
                    <span>{{ $admin->linkedIn }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold">Twitter :</span>
                    <span>{{ $admin->twitter }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-bold">Adresse de localisation :</span>
                    <span>{{ $admin->locationAddress }}</span>
                </div>
            </div>
            <a href="#" onclick="switchToEditMode()" class=" ml-[2%] pt-3 pb-3 px-5 text-[14px] bg-black leading-4 text-white w-fit self-center uppercase font-[600] rounded-full -ml-10 mr-3 duration-200 hover:bg-[#498D13] duration-150 cursor-pointer">Modifier les données de l'administrateur</a>
        </div>

        <!-- Editing mode -->
        <div id="editMode" class="py-2" style="display: none;">
            <h1 class="text-2xl font-bold mb-4">Modifier les données de l'administrateur</h1>
            <form id="editForm" method="POST" action="{{ route('admin.update') }}" class="mt-4 space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label for="adminName" class="block font-bold">Nom d'administration</label>
                    <!-- Add input fields for login and password -->
                    <input type="text" id="login" name="login" value="{{ $admin->login }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="password" class="block font-bold">Mot de passe</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="adminName" class="block font-bold">Nom d'administration</label>
                    <input type="text" id="adminName" name="adminName" value="{{ $admin->adminName }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="phoneNumber" class="block font-bold">Numéro de téléphone</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" value="{{ $admin->phoneNumber }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="whatsappNumber" class="block font-bold">Numéro WhatsApp</label>
                    <input type="text" id="whatsappNumber" name="whatsappNumber" value="{{ $admin->whatsappNumber }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="email" class="block font-bold">Email</label>
                    <input type="email" id="email" name="email"value="{{ $admin->email }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="facebook" class="block font-bold">Facebook</label>
                    <input type="text" id="facebook" name="facebook" value="{{ $admin->facebook }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="instagram" class="block font-bold">Instagram</label>
                    <input type="text" id="instagram" name="instagram" value="{{ $admin->instagram }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="linkedIn" class="block font-bold">LinkedIn</label>
                    <input type="text" id="linkedIn" name="linkedIn" value="{{ $admin->linkedIn }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="twitter" class="block font-bold">Twitter</label>
                    <input type="text" id="twitter" name="twitter" value="{{ $admin->twitter }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="space-y-2">
                    <label for="locationAddress" class="block font-bold">Adresse de localisation</label>
                    <input type="text" id="locationAddress" name="locationAddress" value="{{ $admin->locationAddress }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class=" flex  ml-[2%] pt-3 pb-3 px-5 text-[14px] bg-[#498D13]  leading-4 text-white w-fit self-center uppercase font-[600] rounded-full -ml-10 mr-3 duration-200 hover:text-white hover:bg-black duration-150 cursor-pointer">Mettre à jour</button>
                    <button type="button" onclick="cancelEdit()" class=" flex  ml-[2%] pt-3 pb-3 px-5 text-[14px] bg-black leading-4 text-white w-fit self-center uppercase font-[600] rounded-full -ml-10 mr-3 duration-200 hover:text-white hover:bg-[#498D13] duration-150 cursor-pointer">Annuler</button>
                </div>
            </form>
        </div>
</section>

</body>

</html>
