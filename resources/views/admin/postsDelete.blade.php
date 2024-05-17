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
    <style>
        nav div.active::before,
        nav div.active::after {
            border-radius: 1rem;
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            right: 0rem;
            background: #498D13;
        }

        nav div.active::before {
            border-radius: 0 0 1rem;
            bottom: 3rem;
            box-shadow: 5px 5px 0 5px white;
        }

        nav div.active::after {
            border-radius: 0 1rem 0 0;
            top: 3rem;
            box-shadow: 5px -5px 0 5px white;
        }

        .post {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
            display: flex;
        }
        .post img {
            max-width: 20%;
            height: auto;
        }
        .post .title {
            font-size: 20px;
            margin-top: 10px;
        }
        .post .date {
            font-style: italic;
            color: #888;
        }
        .delete-btn {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>


    {{-- Styles --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">



    <title>Tableau de bord</title>
</head>
<body>
<section class="w-full h-screen flex">
    <aside class="w-[18%] h-full flex flex-col justify-between fixed bg-[#498D13] shadow-md text-white py-5">

        <nav class="ml-3 flex flex-col gap-2 justify-center  text-sm lg:text-base">

            <img class="w-[70%] self-center pb-5" height="400" src="{{ asset('/public/assets/inerp_logo.png') }}"
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
            <div class="h-12 flex justify-evenly items-center active ">
                <i class="fa-solid fa-file-circle-plus"></i>
                <a href="/posts/create" class="hover:underline w-6/12">
                    Ajouter un blog
                </a>
            </div>
            <div class="h-12 flex justify-evenly items-center active bg-white rounded-tl-full rounded-bl-full text-sky-900 font-medium relative ">
                <i class="fa-solid fa-file-circle-plus"></i>
                <a href="/posts/create" class="hover:underline w-6/12">
                    Gerer les blogs
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

    <div class="flex flex-col ml-[19%] w-[80%]">
        <h1 class="text-3xl py-[2%]">Posts</h1>
        @foreach($posts as $post)
            <div class="post items-center justify-between">
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}">
                <div class="title">{{ $post->title }}</div>
                <div class="date">Created at: {{ $post->created_at }}</div>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
        @endforeach

    </div>


</section>
</body>
</html>
