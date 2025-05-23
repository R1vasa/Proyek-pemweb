<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Darumadrop+One&family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <title>sidebar</title>
</head>
<body>
    <div class="flex flex-col w-64 bg-white shadow-lg p-4 min-h-screen sticky border-r border-gray-300">
        <div class="flex items-center mb-4">
            <img src="img/Quack.jpg" alt="Logo" class="w-12 h-12 rounded-full mr-3" />
            <span class="text-2xl font-bold font-[Darumadrop_One]">Quack</span>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">home</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Home</h2>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">search</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Explore</h2>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">notifications</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Notifications</h2>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">bookmark</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Bookmarks</h2>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">person</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Profile</h2>
        </div>
        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="flex items-center p-3 rounded-lg cursor-pointer">
                <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                    <span class="material-symbols-outlined text-black">person</span>
                </span>
                <h2 class="text-md font-semibold font-poppins text-black">Admin Dashboard</h2>
            </div>
        @endif

        <div class="flex-1"></div>
        <a href="/logout" class="mx-auto px-6 py-2 mb-2 bg-amber-500 hover:bg-amber-600 rounded-full font-semibold">Log
            out</a>
    </div>
</body>
</html>