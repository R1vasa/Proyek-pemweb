<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Darumadrop+One&family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Login</title>
</head>

<body class="h-full">
    <div
        class="flex min-h-full flex-col justify-center items-center bg-cover bg-center bg-no-repeat bg-[url(/public/images/background.jpg)]">
        <div class="sm:w-[420px] w-full p-4 rounded-4xl bg-white">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="text-center font-bold tracking-tight text-gray-900 font-[Darumadrop_One] text-5xl">
                    Login
                </h2>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-600 px-4 py-3 rounded relative my-4 w-3/4 mx-auto"
                        role="alert">
                        <strong class="font-bold">Data berhasil ditambahkan! </strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="" method="POST" id="loginForm">
                    @csrf
                    <div class="px-10 sm:px-16">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email/Username</label>
                        <div class="mt-2 flex items-center gap-2 border-b border-gray-300">
                            <i class='bx bx-user text-xl text-gray-500'></i>
                            <input type="text" name="email" id="email" value="{{ old('email') }}"
                                placeholder="Type your Username"
                                class="w-full sm:text-base text-sm focus:outline-none py-2">
                        </div>
                    </div>

                    <div class="px-10 sm:px-16 mt-4">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2 flex items-center gap-2 border-b border-gray-300">
                            <i class='bx bx-lock-alt text-xl text-gray-500'></i>
                            <input type="password" name="password" id="password" autocomplete="current-password"
                                placeholder="Type your Password"
                                class="w-full sm:text-base text-sm focus:outline-none py-2">
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="opacity-50 w-1/3 rounded-md bg-yellow-300 px-3 py-1.5 text-sm font-semibold text-black shadow"
                            id="loginBtn">
                            Login
                        </button>
                    </div>
                </form>

                <div>
                    <p class="text-center text-[13px]">Or Sign in Using</p>
                    <div class="flex justify-center text-3xl gap-2">
                        <i class='bx bxl-google cursor-pointer'></i>
                        <i class='bx bxl-facebook-circle cursor-pointer'></i>
                        <i class='bx bxl-twitch cursor-pointer q'></i>
                    </div>
                    @if ($errors->any())
                        <div class="text-red-600 pt-2 rounded relative w-3/4 mx-auto">
                            @foreach ($errors->all() as $items)
                                <p class="text-center">{{ $items }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>

                <p class="mt-10 text-center text-sm/6 text-gray-500">
                    Don't have an account
                    <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign up here</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
