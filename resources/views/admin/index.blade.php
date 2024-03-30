<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    @vite('resources/css/admin/index.css')
    @vite('resources/js/admin/login.js')

    <title>Admin Login</title>
</head>

<body class="bg-gray-100">

    <section class="w-full h-screen flex flex-col justify-center items-center">
        <form action="{{ route('admin.loginHandler') }}" method="POST" class="adminForm">

            <h1 class="text-center text-sm md:text-base lg:text-xl font-medium">Admin Login</h1>

            @csrf

            <input type="text" placeholder="Identifiant" class="adminInput" name="adminLogin">
            @error('adminLogin')
                <p class="text-xs text-red-500">
                    {{ $message }}
                </p>
            @enderror

            <div class="flex justify-between adminInput">
                <input type="password" placeholder="Mot de passe" class="adminInput" name="adminPwd" id="pass">
                <img src="/icons/eyeOpen.svg" alt="Show Passeword" class="w-6 m-3 cursor-pointer" id="showHidePass">
            </div>
            @error('adminPwd')
                <p class="text-xs text-red-500">
                    {{ $message }}
                </p>
            @enderror

            <button type="submi" class="connectBtn">
                Se connecter
            </button>
        </form>
    </section>

</body>

</html>
