<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Darumadrop+One&family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
        .latar {
            background-image: url('background.jpg');
        }
    </style>
    <title>Register</title>
</head>

<body class="h-full">
    <div
        class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8 bg-cover bg-center bg-no-repeat latar">
        <div class="md:border-1 md:w-[420px] p-4 rounded-4xl bg-white">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="text-center font-bold tracking-tight text-gray-900 font-[Darumadrop_One] text-5xl">
                    Register
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="/register/create" method="POST">
                    @csrf

                    <div class="px-10 sm:px-16">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2 flex items-center gap-2 border-b border-gray-300">
                            <i class='bx bx-envelope text-xl text-gray-500'></i>
                            <input type="email" name="email" autocomplete="email" placeholder="Type your Email"
                                class="w-full sm:text-base text-sm focus:outline-none">
                        </div>
                    </div>

                    <div class="px-16">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                        <div class="mt-2 flex items-center gap-2 border-b border-gray-300">
                            <i class='bx bx-user text-xl text-gray-500'></i>
                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                placeholder="Type your Username"
                                class="w-full sm:text-base text-sm focus:outline-none py-2">
                        </div>
                    </div>

                    <div class="px-16">
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
                            class="cursor-pointer w-1/3 max-w-xs rounded-md bg-yellow-300 px-3 py-1.5 text-sm font-semibold text-black shadow hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Register
                        </button>
                    </div>

                </form>

                <p class="mt-10 text-center text-sm/6 text-gray-500">
                    Already have an account
                    <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign up here</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
